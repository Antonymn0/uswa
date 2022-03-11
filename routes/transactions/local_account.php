<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// -------------- Protected routes -----------------
Route::group(['middleware'=>['auth:api']],function(){
   
    //transaction history routes     
    Route::get('/get-transaction-history','Api\Payments\TransactionHistoryController@getHistory');

    //transaction history routes     
    Route::post('/transaction','Api\Payments\TransactionHistoryController@store'); 
        
});