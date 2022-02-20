<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\TutorSchedule\TutorScheduleController;
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
        $users = User::paginate(env('API_PAGINATION', 10));
        return response()->json([
            'success'=> true,
            'message' => 'A list of users',
            'data'=>$users], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\ValidateUser  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateUser $request)
    {
        $data = $request->validated();

        $user_data = Utilities::createNamesFromFullName($data);
        $user_data['password']  = Hash::make($data['password']);        

        $new_user= User::create($user_data);
        // event(new userCreated($new_user));

        $user =   Auth::attempt([
            'email' => $new_user->email,
            'password' => $data['password'],
            ]);
        $token = auth()->user()->createToken('token')->accessToken;

        return response()->json([
            'success'=> true,
            'message'=> 'User created successfuly',
            'data' => $user,
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
            'message'=> 'Á single user retrieved successfully', 
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
        // if($request->hasFile('image')){  
        //    $path = $request->file('image')->store('images', 's3'); // send image to AWS S3         
        //    \Storage::disk('s3')->setVisibility($path, 'public'); // set file visibility to public
        //    $path = \Storage::disk('s3')->url($path);  // create file path
        // $data['image'] = $path;
        // }  
        // $user->update($data);
         (new TutorScheduleController)->store($request, $user->id);

        event(new UserUpdated($user));
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

}
