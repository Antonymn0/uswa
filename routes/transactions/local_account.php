<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// -------------- Protected routes -----------------
Route::group(['middleware'=>['auth:api']],function(){

    //Account routes     
    Route::get('/get-account-balance','Api\Payments\LocalAccountController@getAccountBalance'); 
   
    //transaction history routes     
    Route::get('/get-transaction-history','Api\Payments\TransactionHistoryController@getHistory');

    //transaction history routes     
    Route::post('/transaction','Api\Payments\TransactionHistoryController@store');     
});