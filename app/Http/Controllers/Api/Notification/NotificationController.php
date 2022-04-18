<?php

namespace App\Http\Controllers\Api\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Http\Requests\Notification\ValidateNotificationRequest;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notification = Notification::paginate(env('API_PAGINATION', 10));
        return response()->json([
            'success'=> true,
            'message'=> 'A list of notifications',
            'data' => $notification,            
            ],  200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\ValidateNotificationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateNotificationRequest $request)
    {
        $data = $request->validated();       

        $notification= Notification::create($data);
        return response()->json([
            'success'=> true,
            'message'=> 'Notification created successfuly',
            'data' => $notification,
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
        $notification = Notification::findOrFail($id);
        return response()->json([
            'success'=> true,
            'message'=> 'Á single notification retrieved successfully', 
            'data'=>$notification], 200);
    }

   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id)->delete();
        return response()->json([
            'success'=> true, 
            'message'=> 'Notification deleted successfuly', 
            'data'=>true], 200);
    }

    /**
     * Get tutor notifications
     */
    public function getTutorNotifications($id){
        $notifications = Notification::where('recipient', $id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(env('API_PAGINATION', 10));
        return response()->json([
            'success'=> true, 
            'message'=> 'Tutor notifications fetched', 
            'data'=>$notifications
            ], 200);
    }

    /**
     * Get student notifications
    */
    public function getStudentNotifications($id){
        $notifications = Notification::where('recipient', $id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(env('API_PAGINATION', 10));
        return response()->json([
            'success'=> true, 
            'message'=> 'Student notifications fetched', 
            'data'=>$notifications
            ], 200);
    }

    /**
     * mark notifification read
     */
    public function readNotification(Request $request, $id)
    {
        $notification = Notification::findOrFail($id);
        $notification-> update([ 'status'=> 'read' ]);

        return response()->json([
            'success'=> true, 
            'message'=> 'Success notification marked read', 
            'data'=>true
            ], 200);
    }
}
