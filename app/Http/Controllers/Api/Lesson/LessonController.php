<?php

namespace App\Http\Controllers\Api\Lesson;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Notification;
use App\Events\Lesson\lessonCreated;
use App\Events\Lesson\lessonUpdated;
use App\Events\Lesson\lessonDestroyed;
use App\Http\Requests\Lesson\ValidateLessonRequest;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lesson = Lesson::with('getLessonStudent')
                ->with('getLessonTutor')
                ->paginate(env('API_PAGINATION', 10));
        return response()->json([
            'success'=> true,
            'message' => 'A list of lessons',
            'data'=>$lesson], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\ValidateLessonRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateLessonRequest $request)
    {
        $data = $request->validated(); 
        $lesson= Lesson::create($data);

        $Notification = Notification::create([
            'sender' => $request->student_id,
            'recipient' => $request->tutor_id,
            'title' => 'New  lesson created' ,
            'body' => 'A new lesson has been created  for you. Please check you dashboard for more.',
            'status' => 'sent'
        ]);

        return response()->json([
            'success'=> true,
            'message'=> 'Lesson created successfuly',
            'data' => $lesson,
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
        $lesson= Lesson::findOrFail($id);
        return response()->json([
            'success'=> true,
            'message'=> 'Á single lesson retrieved successfully', 
            'data'=>$lesson], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\ValidateLessonRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidateLessonRequest $request, $id)
    {
        $data = $request->validated();
        $lesson = Lesson::findOrFail($id);

        $lesson->update($data);

        event(new lessonUpdated($lesson));
        return response()->json([
            'success'=> true,
            'message'=> 'Lesson updatedsuccessfully', 
            'data'=>$lesson
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
        $lesson= Lesson::findOrFail($id)->delete();
        event(new lessonDestroyed($lesson));
        return response()->json([
            'success'=> true, 
            'message'=> 'lesson deleted successfuly', 
            'data'=>true], 200);
    }

    /**
     * Update meeting link
     */
    public function updateMeetingLink(Request $request, $id ){
        $trial_lesson = Lesson::findOrFail($id);
        $trial_lesson->update([
            'meeting_link' => $request->meeting_link,
            'meeting_id' => $request->meeting_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Lesson meeting link updated',
            'data' =>true
        ],200);
    }

}
