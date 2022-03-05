<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// -------------- Protected routes -----------------
Route::group(['middleware'=>['auth:api']],function(){

    //tutor notifications routes
    Route::get('/tutor/notifications/get/{user_id}','Api\Notification\NotificationController@getTutorNotifications');
    
    //student notifications routes
    Route::get('/student/notifications/get/{user_id}','Api\Notification\NotificationController@getStudentNotifications');
   
    
});