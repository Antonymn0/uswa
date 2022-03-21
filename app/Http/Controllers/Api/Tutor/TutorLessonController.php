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
            ->where('tutor_id', $user->id)
            ->paginate(env('API_PAGINATION', 10));

        return response()->json([
            'success' => true,
            'message' => 'A list of tutor  lessons',
            'data' => $lesson
        ], 200);
    }

    
}
