<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Events\EmailVerification\SendEmailVerificationLink;

class EmailVerificationController extends Controller
{    
    /**
     * Send email verification link
     * @param emailaddress $request
     */
    public function sendVerificationLink(Request $request){
        $email =   $request->validate([           
            'email' => ['required', 'email', 'max:255']           
        ]);
        
        if(! empty($email)){            
            $user =   User::where('email', $email)->first();
            
            if(! empty($user))  { event(new SendEmailVerificationLink($user));  return ' Success, Verification link sent.'; }
            else return  'User not found';            
        }
        else return  'Invalid email';
    }

    /**
     * Verify email address
     */
    public function verifyEmail($email){
         
        if(!empty($email)){
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) return;

            $user =   User::where('email', $email)->first(); 
            if(!$user) return;           
            $user->update([
                'email_verified_at' => now()
            ]);
            return redirect('home');          
        }
    }
}
