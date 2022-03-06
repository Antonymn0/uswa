<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Check if database is empty to register admin
     */
    public function checkIfDBEmpty(Request $request)
    {
        $user = User::first();

        if(empty($user)) { // if empty db
            return response()->json([
                'success' => false,
                'message' => 'Db is empty',
                'data' => false
            ],404);
        }
        else  return response()->json([ // if db not empty
            'success' => true,
            'message' => 'Db is not empty',
            'data' => true
        ],200);
    } 
}
