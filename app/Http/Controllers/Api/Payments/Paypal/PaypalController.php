<?php

namespace App\Http\Controllers\Api\Payments\Paypal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaypalAuthToken;
use Illuminate\Support\Facades\Log;
use App\Models\LocalAccount;
use App\Models\TransactionHistory;
use App\Models\User;
use App\Events\PaypalPayments\paymentAuthorised;
use App\Events\PaypalPayments\paymentProcessed;
use App\Events\PaypalPayments\paypalMerchantOnbordingSuccess;
class PaypalController extends Controller
{
    /**
    * Generate paypal access token from paypal servers
    */
    public function getAccessToken(){
            $uri = 'https://api.sandbox.paypal.com/v1/oauth2/token';
            $clientId = env('PAYPAL_CLIENT_ID');
            $secret = env('PAYPAL_CLIENT_SECRET');

            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', $uri, [
                    'headers' => [
                            'Accept' => 'application/json',
                            'Accept-Language' => 'en_US',
                            'Content-Type' => 'application/x-www-form-urlencoded',
                        ],
                    'body' => 'grant_type=client_credentials',
                    'auth' => [$clientId, $secret, 'basic']
                ]
            );
            $data =  json_decode($response->getBody());

            // save response to the databse            
            $token_data = [
                'provider' => 'paypal',
                'token' => $data->access_token ,
                'token_type' => $data->token_type ,
                'app_id' => $data->app_id ,
                'expires_in' => $data->expires_in,
                'nonce' => $data->nonce,
                'scope' => $data->scope,
            ];

            $auth_token = PaypalAuthToken::first();

            if(empty($auth_token))  PaypalAuthToken::create($token_data);
            else  $auth_token->update($token_data);

            return  response()->json([
                'success'=> true,
                'message'=> 'Paypal token generated successfully',
                'data'=> true,
            ],200);
         
    }

    /**
    * Handle patner onboarding redirect url
    */
    public function handlePatnerOnboardingRedirect(Request $request){
        // update user with paypal particulars
        $user = User::findOrFail($request->merchantId);
        $data = [
            'paypal_merchant_id' => $request->merchantIdInPayPal,
            'paypal_consent_status' => $request->consentStatus,
            'paypal_permissions_granted' => $request->permissionsGranted
        ];

        $user->update($data);

        event(new paypalMerchantOnbordingSuccess($user));
        return redirect('/');
    }

    /**
     * Get paypal client ID
     */
    public function getClientId(Request $request){
        return response()->json([
            'success' => true,
            'data'=> env('PAYPAL_CLIENT_ID'),
            'message' => 'paypal clientId success'
        ]);
    }
   
   /**
    * Generate paypal seller/merchant onboarding link
    */
   public function generateSignupLink(Request $request){
        $this->getAccessToken();
        $user = $request->user();

        $uri = 'https://api-m.sandbox.paypal.com/v2/customer/partner-referrals';
        $token= PaypalAuthToken::first()->token;
        $body =  [
            "tracking_id"=> strval($user->id) ,
            "operations"=> [
                [
                    "operation"=> "API_INTEGRATION",
                    "api_integration_preference"=> [
                    "rest_api_integration"=> [
                        "integration_method"=> "PAYPAL",
                        "integration_type"=> "THIRD_PARTY",
                        "third_party_details"=> [
                        "features"=> [
                            "PAYMENT",
                            "REFUND"
                        ]
                        ]
                    ]
                    ]
                ]
            ],
             "partner_config_override"=> [
                "return_url"=> url("/api/paypal-onboarding/redirect"),
             ],
            "products"=> [
                "EXPRESS_CHECKOUT"
            ],
            "legal_consents"=> [
                [
                    "type"=> "SHARE_DATA_CONSENT",
                    "granted"=> true
                ]
            ]
        ];

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $uri, [
            'headers' => [
                    'Accept' => 'application/json',
                    'Accept-Language' => 'en_US',
                    'Authorization' => 'Bearer ' . $token
                ],
            'json' => $body,
            ]
        );

        $data = json_decode($response->getBody(), true);
        return $data;
   }


   /**
    * Create charge object for payment processing
    */
    public function withdrawFunds(Request $request){ 
        $tutor =  $request->user();
        $tutor_local_account = LocalAccount::where('user_id', $request->user()->id)->first();

        if(empty($tutor_local_account)) return;
        if($tutor_local_account->available_balance < 50) return; // dont withdraw accounts less than 50 balance

        $this-> getAccessToken(); // refresh paypal access token

        $token= PaypalAuthToken::first()->token;
        $uri = 'https://api-m.sandbox.paypal.com/v2/checkout/orders';
        $client = new \GuzzleHttp\Client();
        $body = [
                "intent"=> "CAPTURE",
                "purchase_units"=> [
                    [
                    "amount"=> [
                        "currency_code"=> "USD",
                        "value"=> $tutor_local_account->available_balance
                        ],
                    'payee' => [
                                'merchant_id' =>  $tutor->paypal_merchant_id
                            ],
                    ]
                ]
                ];
        $response = $client->request('POST', $uri, [
                    'headers' => [
                            'Accept' => 'application/json',
                            'Accept-Language' => 'en_US',
                            'Authorization' => 'Bearer  ' . $token
                        ],
                    'json' => $body,
                    ]
                );
        $data = json_decode($response->getBody());

        // update local tutor account
        $acc_data = [
            'last_transaction_date' => now(),
            'last_transaction_method' => 'paypal',
            'last_amount_transacted' => $tutor_local_account->available_balance,
            'balance_before' => $tutor_local_account->available_balance,
            'available_balance' => 0,
            'balance_after' => 0, 
        ];
        // record transaction
        $trans_data =[
            'user_id' => $tutor->id,
            'transaction_id' => $data->id,
            'transaction_type' => 'disburse:funds',
            'payment_method' => 'paypal',
            'amount_transacted' => $tutor_local_account->available_balance,
            'transacted_from' => 'Uswa',
            'transacted_to' =>  $tutor->email,
            'commision_charged' =>0 ,
            'balance_before' => $tutor_local_account->available_balance,
            'balance_after' => 0,
            'transaction_date' => now(),
            'remarks' => 'Withraw:funds ' ,
            'status' => 'Complete',
        ];
        $tutor_local_account->update($acc_data);
        $transaction_history = TransactionHistory::create($trans_data); // record history  

        return $data;    
    }

    /**
     * Capture authorized payment
     */
    public function captureAuthorizedPAyment(Request $request, $transaction, $transaction_id)
    { 
        $user = $request->user();

        // capture/process payment 
        $uri = 'https://api-m.sandbox.paypal.com/v2/payments/authorizations/' . $transaction_id . '/capture';
        $token= PaypalAuthToken::first()->token;

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $uri, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
                'PayPal-Request-Id' => uniqid()
                ], 
            'json'=>[
                'payment_instruction' =>  [
                    'disbursement_mode' =>  'INSTANT',
                    // 'platform_fees' =>  [[
                    //     'amount' =>  [
                    //         'currency_code' =>  'USD',
                    //         'value' =>  $commisson_amount
                    //     ]
                    // ]]
                ],
            ],  
        ]);

        $data = json_decode($response->getBody());

        $account = LocalAccount::where('user_id', $user->id)->first();

        // update local account balance
        $acc_data = [
            'last_transaction_date' => now(),
            'last_transaction_method' => 'paypal',
            'last_amount_transacted' => $transaction->amount_transacted,
            'balance_before' => $account->available_balance,
            'available_balance' => $account->available_balance + $transaction->amount_transacted,
            'balance_after' => $account->available_balance + $transaction->amount_transacted,
        ];

         // record transaction in db
        $trans_data =[
            'user_id' => $user->id,
            'transaction_id' => $data->id,
            'transaction_type' => 'Transer:funds',
            'payment_method' => 'paypal',
            'amount_transacted' => $transaction->amount_transacted,
            'transacted_from' => $transaction->transacted_from,
            'transacted_to' =>  $transaction->transacted_to,
            'commision_charged' => $transaction->commision_charged ,
            'balance_before' => $account->available_balance,
            'balance_after' => $account->available_balance + $transaction->amount_transacted,
            'transaction_date' => now(),
            'remarks' => 'Top up Uswa acc ' ,
            'status' => 'Complete',
        ];
        $account->update($acc_data);  // update
        $transaction_history = TransactionHistory::create($trans_data); // record history

        $transaction->update(['status'=>'complete']);

        event(new paymentProcessed($user, $transaction_history));

        return $data;
    }

    /**
     * update local account after a payment authorization is successful
    */
    public function updateLocalAccount(Request $request){
 
        $user = $request->user();
        $account = LocalAccount::where('user_id', $user->id)->first();
        // update local account balance
        $acc_data = [
            'last_transaction_date' => now(),
            'last_transaction_method' => 'paypal',
            'last_amount_transacted' => $request->purchase_units[0]['payments']['authorizations'][0]['amount']['value'],
            'balance_before' => $account->available_balance,
            'available_balance' => $account->available_balance + $request->purchase_units[0]['payments']['authorizations'][0]['amount']['value'],
            'balance_after' => $account->available_balance + $request->purchase_units[0]['payments']['authorizations'][0]['amount']['value'],
        ];
        
        // record transaction in db
        $trans_data =[
            'user_id' => $user->id,
            'transaction_id' => $request->purchase_units[0]['payments']['authorizations'][0]['id'],
            'transaction_type' => 'Authorise:paypal',
            'payment_method' => 'paypal',
            'amount_transacted' => $request->purchase_units[0]['payments']['authorizations'][0]['amount']['value'],
            'transacted_from' => $request->payer['email_address'],
            'transacted_to' => $request->purchase_units[0]['payee']['email_address'] ,
            'commision_charged' => 0 ,
            'balance_before' => $account->available_balance,
            'balance_after' => $account->available_balance + $request->purchase_units[0]['payments']['authorizations'][0]['amount']['value'],
            'transaction_date' => now(),
            'remarks' => 'Authorise:paypal ' ,
            'status' => 'Complete',
        ];

        $transaction = TransactionHistory::create($trans_data);           
        // $account->update($acc_data);  // update  

        // event(new paymentAuthorised($user, $transaction));

        $transaction_id = $request->purchase_units[0]['payments']['authorizations'][0]['id'];

        $this->captureAuthorizedPAyment($request, $transaction, $transaction_id );

        return $account;
    }

   
}
