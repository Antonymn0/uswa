
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
        Route::apiResource('/student/conversation-thread', 'Api\Conversation\ConversationThreadController'); 

        // student send message route
        Route::post('/student/send-message','Api\Conversation\ConversationThreadController@store')->name('student.send.message');

        // student get current message route
        Route::get('/student/get-message/{id}','Api\Conversation\ConversationController@show')->name('student.get.message');

        // student update conversation seen
        Route::get('/student/update-seen/{id}','Api\Conversation\ConversationController@updateSeen')->name('student.update.seen');
        
        // student delete current message thread route
        Route::delete('/student/get-message/{id}','Api\Conversation\ConversationController@destroy')->name('student.delete.message-thread');
        
        // fetch trial lessons
        Route::get('/students/fetch-lessons/trial','Api\Student\StudentController@fetchTrialLessons')->name('student.fetch.trial-lessson');
        
        // cancel trial lesson
        Route::get('/student/cancel-trial-lesson/{id}','Api\Student\StudentController@cancelTrialLesson')->name('student.cancel.trial-lessson');
        
        // fetch lessons
        Route::get('/students/fetch-lessons','Api\Student\StudentLessonController@fetchLessons')->name('student.fetch.lesssons');
       
        // Create lesson
        Route::post('/lessons/create','Api\Lesson\LessonController@store')->name('student.fetch.lesssons');
       
        //update lesson meeting link
        Route::post('/update-lesson-link/{lesson_id}','Api\Lesson\LessonController@updateMeetingLink')->name('student.update.meting-link.lesssons');
       
        //Delete lesson
        Route::delete('/lesson/delete/{lesson_id}','Api\Lesson\LessonController@destroy')->name('delete.lesson');

    });

