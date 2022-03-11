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

//  check if db empty to register admin 
Route::get('/admin/check-db','Api\Admin\AdminController@checkIfDBEmpty');

// -------------------Protected routes -----------------
Route::group(['middleware'=>['auth:api']],function(){
    //Logout route
    Route::get('/logout','Api\Auth\AuthController@logout');
    Route::get('/check-user-authenticated','Api\Auth\AuthController@checkIfUserAuthenticated');

    //USER ROUTE
    Route::get('/user/restore/{id}','Api\User\UserController@restore');
    Route::get('/user/get-deleted','Api\User\UserController@getDeletedRecords');
    Route::get('/user/parmanently-delete/{id}','Api\User\UserController@parmanentlyDelete');  
    Route::apiResource('/user','Api\User\UserController');
    Route::get('/user/search/{email}','Api\User\UserController@searchUserByEmail');

    Route::apiResource('/notifications','Api\Notification\NotificationController');
});



  // Import students routes file
  require __DIR__.'/students/students.php';

  // Import tutors routes file
  require __DIR__.'/tutors/tutors.php';

 

  // Import Zoom video streaming  routes file
  require __DIR__.'/videoStreaming/zoom.php';

  // Import assignments routes file
  require __DIR__.'/assignments/assignments.php';

  // Import assignments routes file
  require __DIR__.'/admin/lessons.php';

  // Import admin tutor routes file
  require __DIR__.'/admin/tutors.php';

  // Import notifications routes file
  require __DIR__.'/notifications/notifications.php';

  // Import reviews routes file
  require __DIR__.'/reviews/reviews.php';

  // Import local_account routes file
  require __DIR__.'/transactions/local_account.php';

  // Import stripe pay routes
  require __DIR__.'/transactions/stripe_pay.php';




// Fall back route
Route::fallback(function() {
  return response()->json([
      'success'=> false,
      'message' => 'No such route found on this server',
      ], 404);
});