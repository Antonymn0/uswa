
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* 
|---------------------------------------------------------------------------
| STUDENTS ROUTES
| Handles routing for all student functions
|-----------------------------------------------------------------------------
*/ 


Route::group(['middleware'=>['auth:api']],function(){
    //
 });

   // Students routes
   Route::get('/student/available-tutors','Api\Student\StudentController@fetch_available_tutors')->name('available.tutors'); 

   // Trial lesson routes
   Route::apiResource('/student/trial-lesson', 'Api\TrialLesson\TrialLessonContoller'); 
  
   // conversation routes
   Route::apiResource('/student/message', 'Api\Conversation\ConversationController'); 

   // conversation thread routes
   Route::apiResource('/student/conversation-thread', 'Api\ConversationThread\ConversationThreadControllerContoller'); 


