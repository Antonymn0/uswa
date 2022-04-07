<?php

namespace App\Http\Controllers\Api\Lecture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lecture;
use App\Http\Requests\Lecture\ValidateLecturerequest;

class LectureController extends Controller
{
    /**
     * Display a listing of the lecture resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $lectures = Lecture::where('tutor_id', $user->id)
                    ->paginate(env('API_PAGINATION', 10));
        return response()->json([
            'success'=> true,
            'message' => 'A list of lectures',
            'data'=>$lectures
            ], 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateLectureRequest $request)
    {
        $data = $request->validated(); 
        $lecture= Lecture::create($data);

        return response()->json([
            'success'=> true,
            'message'=> 'Lecture created successfuly',
            'data' => $lecture,
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
        $lecture= Lecture::findOrFail($id);
        return response()->json([
            'success'=> true,
            'message'=> 'Á single lecture retrieved successfully', 
            'data'=>$lecture], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateLectureRequest $request, $id)
    {
        $data = $request->validated();
        $lecture = Lecture::findOrFail($id);

        $lecture->update($data);

        return response()->json([
            'success'=> true,
            'message'=> 'Lecture updated successfully', 
            'data'=>$lecture
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
        $lecture= Lecture::findOrFail($id)->delete();
        
        return response()->json([
            'success'=> true, 
            'message'=> 'Lecture deleted successfuly', 
            'data'=>true], 200);
    }
}
