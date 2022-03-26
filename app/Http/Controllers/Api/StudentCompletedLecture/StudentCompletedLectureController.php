<?php

namespace App\Http\Controllers\Api\StudentCompletedLecture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Lecture\ValidateStudentCompletedLectureRequest;
use App\Models\StudentCompletedLecture;

class StudentCompletedLectureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $completed_lectures = StudentCompletedLecture::paginate(env('API_PAGINATION', 10));
         return response()->json([
            'success'=> true,
            'message'=> 'A list of  completed_lectures',
            'data' => $completed_lectures,            
            ],  200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateStudentCompletedLectureRequest $request)
    {
        $data = $request->validated();

        $completed_lecture = StudentCompletedLecture::where('student_id', $request->student_id)
                        ->where('lecture_id', $request->lecture_id )
                        ->where('lesson_id', $request->lesson_id)
                        ->first();
        if(! empty($completed_lecture)) {
             return response()->json([
                'success'=> false,
                'message'=> 'Lecture already marked complete',
                'data' => false,
                ],  422);
        }
        else{
            $completed_lecture= StudentCompletedLecture::create($data);
            return response()->json([
                'success'=> true,
                'message'=> 'completed_lecture created successfuly',
                'data' => true,
                ],  201);
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $completed_lecture= StudentCompletedLecture::findOrFail($id);
        return response()->json([
            'success'=> true,
            'message'=> 'Á single completed_lecture retrieved successfully', 
            'data'=>$completed_lecture
            ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateStudentCompletedLectureRequest $request, $id)
    {
        $data = $request->validated();  

        $completed_lecture = StudentCompletedLecture::findOrFail($id);
        $completed_lecture->update($data);

        return response()->json([
            'success'=> true, 
            'message'=>'Completed lecture updated successfuly', 
            'data'=>true],  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $completed_lecture = StudentCompletedLecture::findOrFail($id)->delete();
        return response()->json([
            'success'=> true, 
            'message'=> 'completed_lecture deleted successfuly', 
            'data'=>true
            ], 200);
    }
}
