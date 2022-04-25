<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// -------------- Protected routes -----------------
Route::group(['middleware'=>['auth:api']],function(){

    //Assignment routes
    Route::apiResource('/courses','Api\Courses\CoursesController');  
    
});