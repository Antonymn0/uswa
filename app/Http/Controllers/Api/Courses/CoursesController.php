<?php

namespace App\Http\Controllers\Api\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Http\Requests\Courses\ValidateCoursesRequest;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
                
        return response()->json([
            'success'=> true,
            'message' => 'A list of courses',
            'data'=>$courses
            ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\ValidateCoursesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateCoursesRequest $request)
    {
        $data = $request->validated(); 
        $course= Course::create($data);

        return response()->json([
            'success'=> true,
            'message'=> 'Course created successfuly',
            'data' => $course,
            ],  201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::findOrFail($id);
        return response()->json([
            'success'=> true,
            'message'=> 'Á single course retrieved successfully', 
            'data'=>$course
            ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateCoursesRequest $request, $id)
    {
        $data = $request->validated();

        $course = Course::findOrFail($id);

        $course->update($data);

        return response()->json([
            'success'=> true,
            'message'=> 'Course updated successfully', 
            'data'=>$course
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id)->delete();
        
        return response()->json([
            'success'=> true, 
            'message'=> 'Course deleted successfuly', 
            'data'=>true
            ], 200);
    }
}
