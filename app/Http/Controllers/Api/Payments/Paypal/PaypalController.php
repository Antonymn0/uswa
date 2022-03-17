<?php

namespace App\Http\Controllers\Api\Payments\Paypal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaypalAuthToken;
use Illuminate\Support\Facades\Log;
use App\Models\LocalAccount;
use App\Models\TransactionHistory;
use App\Models\User;
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
    * Generate paypal seller/merchant onboarding link
    */
   public function generateSignupLink(Request $request){
        $user = $request->user();
        $uri = 'https://api-m.sandbox.paypal.com/v2/customer/partner-referrals';
        $token= PaypalAuthToken::first()->token;
        $body =  [
            "tracking_id"=> '$user->id',
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
             "partner_configuration_override"=> [
                "return_url"=> "https://38d9-197-232-61-216.ngrok.io",
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
    public function createChargeObject(Request $request){
        $token= PaypalAuthToken::first()->token;
        $uri = 'https://api-m.sandbox.paypal.com/v2/checkout/orders';
        $client = new \GuzzleHttp\Client();
        $body = [
                "intent"=> "CAPTURE",
                "purchase_units"=> [
                    [
                    "amount"=> [
                        "currency_code"=> "USD",
                        "value"=> "100.00"
                        ]
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
        return $data;
    }

    /**
     * Capture authorized payment
     */
    public function captureAuthorizedPAyment(Request $request)
    { 
        $commision_rate = 10; // 10% commision
        $user = $request->user();
        $payment_on_hold = TransactionHistory::where('user_id', $user->id)
                                                ->where('status', 'onhold')
                                                ->first();
        if(!empty($$payment_on_hold)) return $payment_on_hold;

        $commisson_amount = $commision_rate/100 * $payment_on_hold->amount_transacted ; // calculate commision

        // capture/process payment 
        $uri = 'https://api-m.sandbox.paypal.com/v2/payments/authorizations/' . $payment_on_hold->transaction_id . '/capture';
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
                    'platform_fees' =>  [[
                        'amount' =>  [
                            'currency_code' =>  'USD',
                            'value' =>  $commisson_amount
                        ]
                    ]]
                ],
            ],  
        ]);

        $data = json_decode($response->getBody());

        $account = LocalAccount::where('user_id', $user->id)->first();

        // update local account balance
        $acc_data = [
            'last_transaction_date' => now(),
            'last_transaction_method' => 'paypal',
            'last_amount_transacted' => $payment_on_hold->amount_transacted,
            'balance_before' => $account->available_balance,
            'available_balance' => $account->available_balance - $payment_on_hold->amount_transacted,
            'balance_after' => $account->available_balance - $payment_on_hold->amount_transacted,
        ];

         // record transaction in db
        $trans_data =[
            'user_id' => $user->id,
            'transaction_id' => $data->id,
            'transaction_type' => 'transfer funds',
            'payment_method' => 'paypal',
            'amount_transacted' => $payment_on_hold->amount_transacted,
            'transacted_from' => $payment_on_hold->transacted_from,
            'transacted_to' =>  $payment_on_hold->transacted_to,
            'commision_charged' => $commisson_amount ,
            'balance_before' => $account->available_balance,
            'balance_after' => $account->available_balance - $payment_on_hold->amount_transacted,
            'transaction_date' => now(),
            'remarks' => 'Transafer paypemnts to tutor ' ,
            'status' => 'Complete',
        ];
        $account->update($acc_data);  // update
        $transaction = TransactionHistory::create($trans_data); // record history

        return $data;
    }

    /**
     * update local account after an authorization is successful
    */
    public function updateLocalAccount(Request $request){
        
        // Log::info($request->intent);
        // Log::info($request->payer['payer_id']);
        // Log::info($request->payer['email_address']);
        // Log::info($request->purchase_units[0]['payments']['authorizations'][0]['id']);        
        // Log::info($request->purchase_units[0]['payments']['authorizations'][0]['amount']['currency_code']);
        // Log::info($request->purchase_units[0]['payments']['authorizations'][0]['amount']['value']);
        // Log::info($request->purchase_units[0]['payee']['email_address']);
        // Log::info($request->purchase_units[0]['payee']['merchant_id']);

        
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
            'transaction_type' => 'authorise:paypal',
            'payment_method' => 'paypal',
            'amount_transacted' => $request->purchase_units[0]['payments']['authorizations'][0]['amount']['value'],
            'transacted_from' => $request->payer['email_address'],
            'transacted_to' => $request->purchase_units[0]['payee']['email_address'] ,
            'commision_charged' => 0 ,
            'balance_before' => $account->available_balance,
            'balance_after' => $account->available_balance + $request->purchase_units[0]['payments']['authorizations'][0]['amount']['value'],
            'transaction_date' => now(),
            'remarks' => 'Authorise paypal to hold funds for  lessons ' ,
            'status' => 'onhold',
        ];

        $transaction = TransactionHistory::create($trans_data); 
          
        $account->update($acc_data);  // update  

        return $account;
    }

}
