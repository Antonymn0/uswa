<?php

namespace App\Http\Controllers\Api\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrialLesson;
use App\Models\User;

class TutorTrialLessonController extends Controller
{
    //fetch trial lesson
    public function fetchTrialLessons(Request $request){
        $user = $request->user();
        $trail_lesson = TrialLesson::with('getStudent')
            ->with('getStudent')
            ->where('tutor_id', $user->id)
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
        return response()->json([
            'success' => true,
            'message' => 'Success,  lesson declined',
            'data' => $trail_lesson
        ], 200);
    }
    
}
