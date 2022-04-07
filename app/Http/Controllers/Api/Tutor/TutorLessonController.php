<?php

namespace App\Http\Controllers\Api\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Assignment;
class TutorLessonController extends Controller
{
    //fetch tutor lessons
    public function fetchLessons(Request $request){
        $user = $request->user();

        $lesson = Lesson::with('getLessonStudent')
            ->with('getAssignments')
            ->with('meetings')
            ->with('lectures')
            ->with('completedLectures')
            ->where('tutor_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(env('API_PAGINATION', 10));

        return response()->json([
            'success' => true,
            'message' => 'A list of tutor  lessons',
            'data' => $lesson
        ], 200);
    }

    /**
     * Mark lesson complete
     */
    public function markLessonComplete(Request $request, $lesson_id){
        $lesson = Lesson::findOrFail($lesson_id);

        $lesson->update([ 'status' => 'completed'  ]);

        return response()->json([
            'success' => true,
            'message' => 'Lesson marked complete',
            'data' => true
        ]);
    }
}
