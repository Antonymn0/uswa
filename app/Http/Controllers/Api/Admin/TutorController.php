<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification;

class TutorController extends Controller
{
    /**
     * Fetch unreviewd tutor records
     */
    public function getReviewTutors(Request $request){
        $tutors = User::where('role', 'tutor')
            ->where('registration', 'reviewing')
            ->paginate(env('API_PAGINATION', 10));
        return response()->json([
            'success' => true,
            'message' => 'A list of tutors under review',
            'data' => $tutors
        ],200);
    }

    /**
     * Approve tutor account
    */
    public function approveTutor(Request $request, $id, $keyword){
        $tutor = User::findOrFail($id);
        $tutor->update([
            'registration' => $keyword
        ]);

        $Notification = Notification::create([
            'sender' => $request->user()->id,
            'recipient' => $tutor->id,
            'title' => 'Account approved' ,
            'body' => 'Congratulations. Your account has been approved. You can now start reciving offers from students.',
            'status' => 'sent'
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Tutor account approved',
            'data' => true
        ],200);
    }

    /**
     * rfevert tutor account
    */
    public function revertTutor(Request $request, $id, $message){
        $tutor = User::findOrFail($id);
        $tutor->update([
            'revert_reason' => $message
        ]);

        $Notification = Notification::create([
            'sender' => $request->user()->id,
            'recipient' => $tutor->id,
            'title' => 'Account review declined' ,
            'body' => $message,
            'status' => 'sent'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tutor account reverted successfuly',
            'data' => true
        ],200);
    }

}
