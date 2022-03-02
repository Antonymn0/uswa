<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Assignment;

class StudentLessonController extends Controller
{
    //fetch student lessons
    public function fetchLessons(Request $request){
        $user = $request->user();

        $lesson = Lesson::with('getLessonTutor')
            ->with('getAssignments')
            ->where('student_id', $user->id)
            ->paginate(env('API_PAGINATION', 10));

        return response()->json([
            'success' => true,
            'message' => 'A list of student  lessons',
            'data' => $lesson
        ], 200);
    }
}
