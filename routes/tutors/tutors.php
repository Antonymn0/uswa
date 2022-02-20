
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* 
|-TuTOR ROUTES
| Handles routing for all Tutor actions
|-----------------------------------------------------------------------------
*/ 


    // TUTOR PUBLIC ROUTES
   

    //TUTOR PROTECTED ROUTES
    Route::group(['middleware'=>['auth:api']],function(){

        // tutor conversation routes
        Route::get('/tutor/messages', 'Api\Conversation\ConversationController@getTutorMessages'); 

        // tutor send message route
        Route::post('/tutor/send-message','Api\Conversation\ConversationThreadController@store')->name('tutor.send.message');

        // tutor get current message route
        Route::get('/tutor/get-message/{id}','Api\Conversation\ConversationController@show')->name('tutor.get.message');
        // tutor delete current message thread route
        Route::delete('/tutor/delete-message/{id}','Api\Conversation\ConversationController@destroy')->name('student.delete.message-thread');

        // tutor update conversation seen
        Route::get('/tutor/update-seen/{id}','Api\Conversation\ConversationController@updateSeen')->name('tutor.update.seen');

        // fetch trial lessons
        Route::get('/tutor/fetch-lessons/trial','Api\Tutor\TutorTrialLessonController@fetchTrialLessons')->name('tutor.fetch.trial-lessson');
        // confirm trial lesson
        Route::get('/tutor/confirm-trial-lesson/{id}','Api\Tutor\TutorTrialLessonController@confirmTrialLesson')->name('tutor.confirm.trial-lesssn');
        // decline trial lesson
        Route::put('/tutor/decline-trial-lesson/{id}','Api\Tutor\TutorTrialLessonController@declineTrialLesson')->name('tutor.decline.trial-lesssn');
        
        // fetch lessons
        Route::get('/tutor/fetch-lessons','Api\Tutor\TutorLessonController@fetchLessons')->name('tutor.fetch.lesssons');

        
    });

