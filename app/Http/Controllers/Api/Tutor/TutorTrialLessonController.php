<?php

namespace App\Http\Controllers\Api\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrialLesson;
use App\Models\User;
use App\Models\Notification;
use App\Events\TrialLesson\trialLessonAccepted;
use App\Events\TrialLesson\trialLessonDeclined;

class TutorTrialLessonController extends Controller
{
    //fetch trial lesson
    public function fetchTrialLessons(Request $request){
        $user = $request->user();
        $trail_lesson = TrialLesson::with('getStudent')
            ->with('getStudent')
            ->where('tutor_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(env('API_PAGINATION', 10));

        return response()->json([
            'success' => true,
            'message' => 'A list of tutor trial lessons',
            'data' => $trail_lesson
        ], 200);
    }

    //confirm trial lesson
    public function confirmTrialLesson(Request $request, $id){
        $trail_lesson = TrialLesson::findOrfail($id);
        $trail_lesson -> update([
            'tutor_confirm' => 'accepted'
        ]);

        $student = User::findOrfail($trail_lesson->student_id);
        // event(new trialLessonAccepted($trail_lesson, $student));

        $Notification = Notification::create([
            'sender' => $trail_lesson->tutor_id,
            'recipient' => $trail_lesson->student_id,
            'title' => 'Trial lesson request accepted' ,
            'body' => 'Your trial lesson request has been accepted. Please check your dashboard for more.',
            'status' => 'sent'
        ]); 

        return response()->json([
            'success' => true,
            'message' => 'Success, trial lesson confirmed',
            'data' => $trail_lesson
        ], 200);
    }

    //decline trial lesson
    public function declineTrialLesson(Request $request, $id){
        $trail_lesson = TrialLesson::findOrfail($id);
        $trail_lesson -> update([
            'tutor_confirm' => 'declined',
            'decline_reason' => $request->decline_reason,
        ]);

        $student = User::findOrfail($trail_lesson->student_id);
        event(new trialLessonDeclined($trail_lesson, $student));

        $Notification = Notification::create([
            'sender' => $trail_lesson->tutor_id,
            'recipient' => $trail_lesson->student_id,
            'title' => 'Trial lesson request declined' ,
            'body' => 'Your trial lesson request has been declined. Reason: ' . $request->decline_reason,
            'status' => 'sent'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Success,  lesson declined',
            'data' => $trail_lesson
        ], 200);
    }
    
}
