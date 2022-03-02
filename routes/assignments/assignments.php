
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// -------------- Protected routes -----------------
Route::group(['middleware'=>['auth:api']],function(){

    //Assignment routes
    Route::get('/assignment/restore/{id}','Api\Assignment\AssignmentController@restore');
    Route::get('/assignment/get-deleted','Api\Assignment\AssignmentController@getDeletedRecords');
    Route::get('/assignment/parmanently-delete/{id}','Api\Assignment\AssignmentController@parmanentlyDelete');  
    Route::apiResource('/assignment','Api\Assignment\AssignmentController'); 
    Route::get('/assignment/update-score/{assignment_id}/{score}','Api\Assignment\AssignmentController@updateScore'); 
    
});