<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token;

class AuthController extends Controller
{
    /**
     * Login user
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:4'],
            ]);
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $user->token = auth()->user()->createToken('token')->accessToken;
            return response()->json([
                'success' => true,
                'message' => 'User  successfully logged in',
                'user' => $user            
            ],200);
        }
        return response()->json([
            'success'=> false,
            'message' => 'Invalid credentials!',
        ], 401);
    }

    /**
     * Logout user
    */
    public function logout(Request $request){
        try {
            $request->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
            return response()->json([
                'success' => true,
                'message' => 'User  successfully logged out',
                'token' => $token,
                'data' => false           
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th     
            ],500);
        }   
    }
}
