<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UswaCommisionAccount;
use App\Http\Requests\Admin\ValidateUswaCommisionAccount;
use App\Http\Requests\Admin\UpdateUswaCommisionAccount;
use App\Http\Controllers\Api\Payments\Paypal\PaypalController;
use App\Models\PaypalAuthToken;
use App\Events\CommissionFee\commissionFeeUpdated;

class UswaCommisionAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $account = UswaCommisionAccount::first();
       return response()->json([
            'success' => true,
            'message' => 'Success, Commission fetched',
            'data' => $account
        ],200);
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Requests\Admin\ValidateUswaCommisionAccount $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateUswaCommisionAccount $request)
    {
        $data = $request->validated();
        $account = UswaCommisionAccount::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Success, Commission account created',
            'data' => true
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $account = UswaCommisionAccount::findOrfail($id);
        return $account;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUswaCommisionAccount $request, $id)
    {
        $data = $request->validated();

        $account = UswaCommisionAccount::findOrfail($id);
        $old_account = UswaCommisionAccount::findOrfail($id);

        $account->update($data);

        event( new commissionFeeUpdated( $old_account, $account,));

        return response()->json([
            'success' => true,
            'message' => 'Success, Commission account updated',
            'data' => true
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $account = UswaCommisionAccount::findOrfail($id);
        // $account ->delete();

        return response()->json([
            'success' => False,
            'message' => 'Failed, Operation not allowed',
            'data' => false
        ],200);
    }

    /**
     * Withdraw admin funds from uswa bulk account to paypal personal
     */
    public function  withdrawAdminFunds(Request $request){
        $user =  $request->user();
        $commissions_account = UswaCommisionAccount::first();


        if($commissions_account->available_balance < 50) 
            { 
                return response()->json([
                'success' => false,
                'message' => 'Could not process due to insuficient funds',
                'data' => false
                ],406) ;
            }
        (new PaypalController)->getAccessToken(); // refresh paypal access token


        $token= PaypalAuthToken::first()->token;
        $uri = 'https://api-m.sandbox.paypal.com/v2/checkout/orders';
        $client = new \GuzzleHttp\Client();
        $body = [
                "intent"=> "CAPTURE",
                "purchase_units"=> [
                    [
                    "amount"=> [
                        "currency_code"=> "USD",
                        "value"=> $commissions_account->available_balance
                        ],
                    'payee' => [
                                'merchant_id' =>  $user->paypal_merchant_id
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

        // withdrawal account data
        $uswa_trasanction_data=[
            'available_balance' =>  0,
            'last_amount_transacted' => $commissions_account->available_balance,
            'last_transaction_type' => 'Withdrawal',
            'balance_before' =>  $commissions_account->available_balance,
            'balance_after' => 0,
        ];

        $commissions_account->update($uswa_trasanction_data);

        return response()->json([
            'success' => true,
            'message' => 'Admin funds withdrawal successful',
            'data' => true
        ],200) ;   
    }

   
    
}
