<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TutorSchedule;
use App\Models\TrialLesson;
use App\Models\Review;


class StudentController extends Controller
{
    /*
     |--------------------------------------------------------
     | This controller handles all route actions for students.
     |All nessecary student actions are routed though this controller
     |--------------------------------------------------------------------
     */


    /**
     * Return a list of available tutors to students
    */
    public function fetch_available_tutors(){
        $tutors = User::with('tutorSchedule')
                ->with('reviews')
                ->where('role', 'tutor')
                ->paginate(env('API_PAGINATION', 10));
         return response()->json([
            'success'=> true,
            'message'=> 'A list of available tutors',
            'data' => $tutors,            
            ],  200);
    }

     //fetch trial lessons
    public function fetchTrialLessons(Request $request){
        $user = $request->user();
        
        $trail_lesson = TrialLesson::with('getTutor') 
            ->where('student_id', $user->id)           
            ->paginate(env('API_PAGINATION', 10));

        return response()->json([
            'success' => true,
            'message' => 'A list of tutor trial lessons',
            'data' => $trail_lesson
        ], 200);
    }

     //cancel trial lessons
    public function cancelTrialLesson($id){
        $trail_lesson = TrialLesson::findOrFail($id);
        $trail_lesson->delete(); 
        return response()->json([
            'success' => true,
            'message' => 'trial lesson canceled and deleted.',
            'data' => true
        ], 200);
    }

}
