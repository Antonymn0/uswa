
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// -------------- Protected routes -----------------
Route::group(['middleware'=>['auth:api']],function(){

    //admin tutor routes
     
    Route::get('/admin/get-tutors','Api\Admin\TutorController@getReviewTutors');    
    Route::get('/admin/approve-tutor/{user_id}/{key_word}','Api\Admin\TutorController@approveTutor');    
    Route::get('/admin/revert/tutor/{user_id}/{message}','Api\Admin\TutorController@revertTutor');    
    
});



