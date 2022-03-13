<?php

namespace App\Http\Controllers\Api\Payments\Paypal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaypalAuthToken;

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
   public function generateSignupLink(){
        $uri = 'https://api-m.sandbox.paypal.com/v2/customer/partner-referrals';
        $token= PaypalAuthToken::first()->token;
        $body =  [
            "tracking_id"=> "<Tracking-ID>",
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
                    'Authorization' => 'Bearer  b' . $token
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

}
