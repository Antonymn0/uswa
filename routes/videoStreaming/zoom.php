
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// get zoom credentials
Route::get('/zoom/get-credentials','Api\Zoom\ZoomAuthController@getZoomCredentials')->name('zoom.get.credentials');

// get zoom meetings
Route::get('/zoom/meeting/get','Api\Zoom\ZoomAuthController@getMeetings')->name('zoom.meeting.get');

// update zoom meeting
Route::get('/zoom/meeting/update/{meeting_id}','Api\Zoom\ZoomAuthController@updateZoomMeeting')->name('zoom.meeting.update');



// video streaming chat routes
Route::group(['middleware'=>['auth:api']],function(){

    //get zoom user token
    Route::get('/zoom/user-auth-token','Api\Zoom\ZoomAuthController@getZoomUserToken')->name('zoom.get.user.token');
    
    // create zoom meeting
    Route::get('/zoom/meeting/create','Api\Zoom\ZoomAuthController@createZoomMeeting')->name('zoom.meeting.create');

    // delete zoom meeting
    Route::get('/zoom/meeting/delete/{meeting_id}','Api\Zoom\ZoomAuthController@deleteZoomMeeting')->name('zoom.meeting.delete');
    
    // refresh zoom auth token
    Route::get('/zoom/user-auth-token/refresh','Api\Zoom\ZoomAuthController@refreshZoomAuthToken')->name('zoom.refresh.token');
    
    
});
// update trial lesson meeting link
    Route::post('/update-tial-lesson-link/{id}','Api\TrialLesson\TrialLessonContoller@updateMeetingLink')->name('update.trial.meeting.link');