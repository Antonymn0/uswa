<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\TutorSchedule\TutorScheduleController;
use App\Http\Controllers\Api\Payments\LocalAccountController;
use Illuminate\Support\Facades\Auth;
use App\Events\User\userCreated;
use App\Events\User\userUpdated;
use App\Events\User\userDestroyed;
use App\Http\Requests\User\ValidateUser;
use App\Http\Requests\User\UpdateUser;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Utilities;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(env('API_PAGINATION', 10));
        return response()->json([
            'success'=> true,
            'message' => 'A list of users',
            'data'=>$users], 200);
    }

    /**
     * Store a newly created resource in storage.     *
     * @param  \Illuminate\Http\Request\ValidateUser  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateUser $request)
    {
        $data = $request->validated();

        $user_data = Utilities::createNamesFromFullName($data);
        $user_data['password']  = Hash::make($data['password']);        

        $new_user= User::create($user_data);       
        $credentials= [ 'email' => $new_user->email,  'password' => $data['password'] ];

        $this->createLocalAccount($new_user); // create local transction account
        if($new_user->role == 'tutor') (new TutorScheduleController)->store( $new_user->id); //create tutor schedule

        $user =   Auth::attempt($credentials); // login user
        $token = auth()->user()->createToken('token')->accessToken;        

        // event(new userCreated($new_user));

        return response()->json([
            'success'=> true,
            'message'=> 'User created successfuly',
            'data' => $new_user,
            'token' => $token 
            ],  201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user= User::findOrFail($id);
        return response()->json([
            'success'=> true,
            'message'=> '?? single user retrieved successfully', 
            'data'=>$user], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\UpdateUser  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, User $user)
    {        
        $data = $request->validated(); 
        //upload image
        if($request->hasFile('image')){  
           $path = $request->file('image')->store('images', 's3');          
           \Storage::disk('s3')->setVisibility($path, 'public'); 
           $path = \Storage::disk('s3')->url($path);  
        $data['image'] = $path;
        }  
        // upload video 
        if($request->hasFile('introduction_video')){  
           $path = $request->file('introduction_video')->store('videos', 's3');          
           \Storage::disk('s3')->setVisibility($path, 'public'); 
           $path = \Storage::disk('s3')->url($path);  
        $data['introduction_video'] = $path;
        }  
        // higher education certificate upload 
        if($request->hasFile('higher_education_certificate_upload')){  
           $path = $request->file('higher_education_certificate_upload')->store('images', 's3');          
           \Storage::disk('s3')->setVisibility($path, 'public'); 
           $path = \Storage::disk('s3')->url($path);  
        $data['higher_education_certificate_upload'] = $path;
        }  
        // teaching certificate upload 
        if($request->hasFile('teaching_certificate_upload')){  
           $path = $request->file('teaching_certificate_upload')->store('images', 's3');          
           \Storage::disk('s3')->setVisibility($path, 'public'); 
           $path = \Storage::disk('s3')->url($path);  
        $data['teaching_certificate_upload'] = $path;
        }  

        $user->update($data);

        if($user->role == 'tutor' && isset($request->availability)) (new TutorScheduleController)->update($request, $user->id); //save user schedule

        // event(new UserUpdated($user));
        return response()->json([
            'success'=> true, 
            'message'=>'User updated successfuly', 
            'data'=>$user],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user= User::findOrFail($id)->delete();
        event(new UserDestroyed($user));
        return response()->json([
            'success'=> true, 
            'message'=> 'User deleted successfuly', 
            'data'=>true], 200);
    }

    /**
     * get deleted users from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDeletedRecords()
    {
        $users = User::onlyTrashed()->paginate(env('API_PAGINATION', 10));
        return response()->json([
            'success'=> true, 
            'message'=>'Deleted users fetched successfully', 
            'data'=>$users],  200);
    }
   
    /**
     * Restore the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore( $id)
    {
        $user = User::onlyTrashed()->findOrFail($id)->restore(); 
        return response()->json([
            'success'=> true, 
            'message'=>'User restored', 
            'data'=>$user],  200);
    }

    /**
     * Parmanently remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function parmanentlyDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id)->forceDelete();
        event(new userDestroyed($user)); 
        return response()->json([
            'success' => true,
            'message' => 'User parmanently deleted!',
            'data' => $user
        ], 200);
    }

    /**
     * Search user by email
     */
    public function searchUserByEmail($email){
        $user = User::where('email', $email)->first();
        return response()->json([
            'success' => true,
            'message' => 'Search user by email results!',
            'data' => $user
        ], 200);
    }

    /**
     * Create a new local account for transaction management and record keeping
    */
    public function createLocalAccount($user){
        $data = [
            'user_id' => $user->id,
            'date_created' => now(),
            'balance_before' => 0,
            'available_balance' => 0
        ];

        $request = new Request($data); //create new request object

        (new LocalAccountController)->store($request);
    }

}
