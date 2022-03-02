<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// prevent mixed content error in production
if (App::environment('production')) {
    URL::forceScheme('https');
}

//Login route
  Route::post('/login','Api\Auth\AuthController@login');

  //email verifivation routes
  Route::post('/send-email-verification-link','Api\Auth\EmailVerificationController@sendVerificationLink'); 

// register route 
Route::post('/register','Api\User\UserController@store');


// -------------------Protected routes -----------------
Route::group(['middleware'=>['auth:api']],function(){
    //Logout route
    Route::get('/logout','Api\Auth\AuthController@logout');
    Route::get('/check-user-authenticated','Api\Auth\AuthController@checkIfUserAuthenticated');

    //user routes
    Route::get('/user/restore/{id}','Api\User\UserController@restore');
    Route::get('/user/get-deleted','Api\User\UserController@getDeletedRecords');
    Route::get('/user/parmanently-delete/{id}','Api\User\UserController@parmanentlyDelete');  
    Route::apiResource('/user','Api\User\UserController');
});

  // Import students routes file
  require __DIR__.'/students/students.php';

  // Import tutors routes file
  require __DIR__.'/tutors/tutors.php';

  // Import video streaming  routes file
  require __DIR__.'/videoStreaming/videoStreaming.php';

  // Import Zoom video streaming  routes file
  require __DIR__.'/videoStreaming/zoom.php';

  // Import assignments routes file
  require __DIR__.'/assignments/assignments.php';


// Fall back route
Route::fallback(function() {
return response()->json([
    'success'=> false,
    'message' => 'No such route found on this server',
    ], 404);
});