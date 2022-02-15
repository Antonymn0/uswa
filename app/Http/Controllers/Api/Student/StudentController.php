<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TutorSchedule;

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
        ->where('role', 'tutor')->paginate(env('API_PAGINATION', 10));
         return response()->json([
            'success'=> true,
            'message'=> 'A list of available tutors',
            'data' => $tutors,            
            ],  200);
    }

}
