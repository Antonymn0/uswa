<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// -------------- Protected routes -----------------
Route::group(['middleware'=>['auth:api']],function(){
    //Account routes     
    // Route::get('/register-stripe-connect-account/{country_code}','Api\Payments\Stripe\StripeController@registerStripeConnectAccount'); 
   
   //Account balance routes     
    Route::get('/get-stripe-account-balance','Api\Payments\Stripe\StripeController@getAccountBalance'); 
   
   //create stripe charge objet     
    Route::get('/create-stripe-charge-object','Api\Payments\Stripe\StripeController@createCharge'); 
   
   //create stripe checkout session     
    Route::get('/create-stripe-checkout-session','Api\Payments\Stripe\StripeController@createCheckoutSession'); 
});