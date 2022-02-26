
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// get zoom credentials
Route::get('/zoom/get-credentials','Api\Zoom\ZoomAuthController@getZoomCredentials')->name('zoom.get.credentials');

// create zoom meeting
Route::get('/zoom/meeting/create','Api\Zoom\ZoomAuthController@createZoomMeeting')->name('zoom.meeting.create');

// get zoom meetings
Route::get('/zoom/meeting/get','Api\Zoom\ZoomAuthController@getMeetings')->name('zoom.meeting.get');

// update zoom meeting
Route::get('/zoom/meeting/update/{meeting_id}','Api\Zoom\ZoomAuthController@updateZoomMeeting')->name('zoom.meeting.update');

// delete zoom meeting
Route::get('/zoom/meeting/delete/{meeting_id}','Api\Zoom\ZoomAuthController@deleteZoomMeeting')->name('zoom.meeting.delete');
