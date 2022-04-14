<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// -------------- Protected routes -----------------
Route::group(['middleware'=>['auth:api']],function(){

    //Lessons routes
     
    Route::apiResource('/commissions','Api\Admin\UswaCommisionAccountController');    
    Route::get('/withdraw/admin-funds','Api\Admin\UswaCommisionAccountController@withdrawAdminFunds');    
    
});