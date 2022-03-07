<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// -------------- Protected routes -----------------
Route::group(['middleware'=>['auth:api']],function(){

    //tutor notifications routes
    Route::apiResource('/reviews','Api\Review\ReviewController');
   
    
});