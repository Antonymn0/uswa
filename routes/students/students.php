
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* 
|---------------------------------------------------------------------------
| STUDENTS ROUTES
| Handles routing for all student actions
|-----------------------------------------------------------------------------
*/ 


    // STUDENT PUBLIC ROUTES
    // Students routes
    Route::get('/student/available-tutors','Api\Student\StudentController@fetch_available_tutors')->name('available.tutors'); 


    //STUDENT PROTECTED ROUTES
    Route::group(['middleware'=>['auth:api']],function(){

        // Trial lesson routes
        Route::apiResource('/student/trial-lesson', 'Api\TrialLesson\TrialLessonContoller');

        // conversation routes
        Route::get('/student/get-messages', 'Api\Conversation\ConversationController@getStudentMessages'); 

        // conversation routes
        Route::apiResource('/student/messages', 'Api\Conversation\ConversationController'); 

        // conversation thread routes
        Route::apiResource('/student/conversation-thread', 'Api\ConversationThread\ConversationThreadController'); 

        // student send message route
        Route::post('/student/send-message','Api\Conversation\ConversationThreadController@store')->name('student.send.message');

        // student get current message route
        Route::get('/student/get-message/{id}','Api\Conversation\ConversationController@show')->name('student.get.message');

        // student update conversation seen
        Route::get('/student/update-seen/{id}','Api\Conversation\ConversationController@updateSeen')->name('student.update.seen');
        
        // student delete current message thread route
        Route::delete('/student/get-message/{id}','Api\Conversation\ConversationController@destroy')->name('student.delete.message-thread');
        
        // fetch trial lessons
        Route::get('/student/fetch-lessons/trial','Api\Student\StudentController@fetchTrialLessons')->name('student.fetch.trial-lessson');
        
        // cancel trial lesson
        Route::get('/student/cancel-trial-lesson/{id}','Api\Student\StudentController@cancelTrialLesson')->name('student.cancel.trial-lessson');
   
    });

