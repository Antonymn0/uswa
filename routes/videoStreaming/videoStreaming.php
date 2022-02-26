
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// video streaming chat routes
Route::group(['middleware'=>['auth:api']],function(){

    
    // tutor send message route
    Route::post('/auth/video-stream','Api\VideoStream\VideoStreamController@auth')->name('video.stream.webrtc');


});