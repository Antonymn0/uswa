<?php

namespace App\Http\Controllers\Api\Assignment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Events\Assignment\AssignmentCreated;
use App\Events\Assignment\AssignmentUpdated;
use App\Events\Assignment\AssignmentDestroyed;
use App\Http\Requests\Assignment\ValidateAssignmentRequest;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assignment = Assignment::paginate(env('API_PAGINATION', 10));
        return response()->json([
            'success'=> true,
            'message' => 'A list of assignments',
            'data'=>$assignment], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\ValidateAssignmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateAssignmentRequest $request)
    {
        $data = $request->validated();

        if($request->hasFile('file')){  
            $path = $request->file('file')->store('assignments', 's3'); // send file to AWS S3         
            \Storage::disk('s3')->setVisibility($path, 'public'); // set file visibility to public
            $path = \Storage::disk('s3')->url($path);  // create file path
            $data['assignment_link'] = $path;
            $data['name'] = $request->file('file')->getClientOriginalName();
        } 

        $assignment= Assignment::create($data);
        return response()->json([
            'success'=> true,
            'message'=> 'Assignment created successfuly',
            'data' => $assignment,
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
        $assignment = Assignment::findOrFail($id);
        return response()->json([
            'success'=> true,
            'message'=> 'Á single assignment retrieved successfully', 
            'data'=>$assignment], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\ValidateAssignmentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateAssignmentRequest $request, $id)
    {
        $data = $request->validated();
        $assignment = Assignment::findOrFail($id);

        $assignment->update($data);

        event(new assignmentUpdated($assignment));
        return response()->json([
            'success'=> true,
            'message'=> 'Assignment updated successfully', 
            'data'=>$assignment
            ], 200);
    }

    /**
     * Update score.
     *
     * @param  \Illuminate\Http\Request\ValidateAssignmentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateScore( $id, $score )
    {
        $assignment = Assignment::findOrFail($id);

        $assignment->update([
            'assignment_score' => $score
        ]);
        return response()->json([
            'success'=> true,
            'message'=> 'Assignment score updated successfully', 
            'data'=>true
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
        $assignment = Assignment::findOrFail($id)->delete();
        event(new assignmentDestroyed($assignment));
        return response()->json([
            'success'=> true, 
            'message'=> 'Assignment deleted successfuly', 
            'data'=>true], 200);
    }
}
