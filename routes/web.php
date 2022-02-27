<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ------------------------------------------------------------------------------------------
// zoom token call back route
Route::get('/zoom/auth','Api\Zoom\ZoomAuthController@getZoomAuthToken')->name('zoom.callback.route');

// ----------------------------------------------------------------------------------------------------



//default laravel auth routes (some turned off)
Auth::routes([
    'register'=> false,
    'login'=> false,
    'register' => false,
    'verify' => true,
    ]); 

//email verification routes
Route::get('/verify-email/{email}','Api\Auth\EmailVerificationController@verifyEmail');


 
Route::get('/', function() {
    return view('welcome');
})->name('default');

// vue route 
Route::get('/{any?}', function() {
    return view('welcome');
})->where('any','.*');


// fall back route
  Route::fallback(function() {
        return response()->json([
            'success'=> false,
            'message' => 'No such route found on this web server',
            ], 404);
});
