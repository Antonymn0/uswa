<?php

namespace App\Http\Controllers\Api\Payments\Stripe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    /**
     * Register new stripe connected account for the user.
    */
    public function registerStripeConnectAccount(Request $request, $country_code){
        // get user
        $user = $request->user();

        // create stripe connected account for the user
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
        $stripe_connected_account = $stripe->accounts->create([
            'country' => 'US',
            'type' => 'express',
            'capabilities' => [
                'card_payments' => ['requested' => true],
                'transfers' => ['requested' => true],
                ],
        ] );

        // save response particlars in the user object
        $user ->update([
            'stripe_account_id' => $stripe_connected_account->id,
            'stripe_account_type' => $stripe_connected_account->type
        ]);

        // generate stripe onboarding link
        $account_links = $stripe->accountLinks->create( [
                            'account' => $stripe_connected_account->id,
                            'refresh_url' => url('/'),
                            'return_url' => url('/'),
                            'type' => 'account_onboarding',
                            'collect' => 'eventually_due',
                        ]);

        return $account_links;
   }

    // fetch connected account balance
   public function getAccountBalance(Request $request){
       $user = $request->user();

        $stripe = \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $response  = \Stripe\Balance::retrieve([
            'stripe_account' =>'acct_1Kbsjn2Qo8x5yKRX'
            ]);
        return $response;
    }

    //create customer charge object
    public  function createCharge(Request $request){
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $payment_intent = \Stripe\PaymentIntent::create([
                    'payment_method_types' => ['card'],
                    'amount' => 1000,
                    'currency' => 'usd',
                    'application_fee_amount' => 123,
                    'transfer_data' => [
                        'destination' => 'acct_1Kbsjn2Qo8x5yKRX',
                    ],
                ]);
        return $payment_intent;
    }

    /**
     * Create checkout session
     */
    public function createCheckoutSession(Request $request){
        $price = (object) ['price'=> 1000 ];

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $session = \Stripe\Checkout\Session::create([
                        'payment_method_types' => ['card'],
                        'line_items' => [[
                            'name' => 'Kavholm rental',
                            'amount' => 1000,
                            'currency' => 'usd',
                            'quantity' => 1,
                        ]],
                        'payment_intent_data' => [
                            'application_fee_amount' => 123,
                            'transfer_data' => [
                            'destination' => 'acct_1Kbsjn2Qo8x5yKRX',
                            ],
                        ],
                        'mode' => 'payment',
                        'success_url' => url('/'),
                        'cancel_url' => url('/'),
                    ]);
        return $session;
    }

}
