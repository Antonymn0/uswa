<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// -------------- Protected routes -----------------
Route::group(['middleware'=>['auth:api']],function(){
 
   //get paypal access token    
    Route::get('/get-paypal-access-token','Api\Payments\Paypal\PaypalController@getAccessToken'); 
   
   //generate signup link   
    Route::get('/generate-sigup-link','Api\Payments\Paypal\PaypalController@generateSignupLink'); 

   //generate signup link   
    Route::get('/paypal-payment','Api\Payments\Paypal\PaypalController@createChargeObject'); 
});