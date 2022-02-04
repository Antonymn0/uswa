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

//default laravel auth routes (some turned off)
Auth::routes([
    'register'=> false,
    'login'=> false,
    'register' => false,
    'verify' => true,
    ]); 

Route::get('/{any?}', function() {
    return view('welcome');
});

// fall back route
  Route::fallback(function() {
        return response()->json([
            'success'=> false,
            'message' => 'No such route found on this server',
            ], 404);
});
