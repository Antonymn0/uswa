<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// --------------PAYPAL Protected routes -----------------
Route::group(['middleware'=>['auth:api']],function(){
 
   //get paypal access token    
    Route::get('/get-paypal-access-token','Api\Payments\Paypal\PaypalController@getAccessToken'); 
   
   //generate signup link   
    Route::get('/generate-sigup-link','Api\Payments\Paypal\PaypalController@generateSignupLink'); 

   //charge object   
    Route::get('/paypal-payment','Api\Payments\Paypal\PaypalController@withdrawFunds'); 
   
   //capture authorized payment   
    Route::get('/capture-authorized-payment','Api\Payments\Paypal\PaypalController@captureAuthorizedPAyment'); 
   
   //update local account  
    Route::post('/update/local-account','Api\Payments\Paypal\PaypalController@updateLocalAccount'); 
   
   //update local account  
    Route::get('/get-paypal-clientId','Api\Payments\Paypal\PaypalController@getClientId'); 

   //transfer payments from student to tutor locally
    Route::post('/transfer-payments','Api\Payments\LocalAccountController@transferFundsFromStudentToTutor');  
   
});

