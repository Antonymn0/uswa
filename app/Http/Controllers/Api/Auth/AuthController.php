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
            try {
                $user = Auth::user();
                $token = auth()->user()->createToken('token')->accessToken;
                return response()->json([
                    'success' => true,
                    'message' => 'User  successfully logged in',
                    'user' => $user,
                    'token' => $token            
                ],200);
            } catch (\Throwable $th) {
                return $th;
            }
           
        }
        return response()->json([
            'success'=> false,
            'message' => 'Invalid credentials!',
        ], 401);
    }

    /**
     * Logout user
    */
    public function logout(Request $request)
    {       
       if($request){
          $request->user()->token()->revoke();
            return response()->json([
                'success' => true,
                'message' => 'User  successfully logged out',
                'data' => false           
            ],200);
       }
       else{
            return response()->json([
                'success' => false,
                'message' => 'User  not authenitcated',
                'data' => false           
            ],401);
       }         
    }

    // check if user is authenticated and token still valid 
    public function checkIfUserAuthenticated(Request $request){
        if($request){
            $user =  $request->user();
            $token =  $request->user()->token();
            return response()->json([
                'success' => true,
                'message' => 'User  valid and authenticated',
                'user' => $user,           
            ],200);
        }
        else  return false;            

    }
}
