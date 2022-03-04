<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// -------------- Protected routes -----------------
Route::group(['middleware'=>['auth:api']],function(){

    //Lessons routes
     
    Route::get('/lessons','Api\Lesson\LessonController@index'); 
   
    
});