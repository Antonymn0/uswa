<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Assignment;
use Illuminate\Support\Facades\Log;
use App\Models\Lecture;

class StudentLessonController extends Controller
{
    //fetch student lessons
    public function fetchLessons(Request $request){
        $user = $request->user();

        $lesson = Lesson::with('getLessonTutor')
            ->with('getAssignments')
            ->with('meetings')
            ->with('lectures')
            ->with('completedLectures')
            ->where('student_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(env('API_PAGINATION', 10));

        return response()->json([
            'success' => true,
            'message' => 'A list of student  lessons',
            'data' => $lesson,
        ], 200);
    }
}
