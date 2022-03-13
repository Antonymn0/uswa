<?php

namespace App\Http\Controllers\Api\TrialLesson;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrialLesson;
use App\Models\Notification;
use App\Models\User;
use App\Http\Requests\TrialLesson\ValidateTrialLesson;
use App\Events\TrialLesson\trialLessonCreated;

class TrialLessonContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\ValidateTrialLesson  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateTrialLesson $request)
    {
        $data = $request->validated();

        $trial_lesson = TrialLesson::create($data);

        $tutor = User::findOrfail($request->tutor_id);
        event(new trialLessonCreated($trial_lesson, $tutor));

        $Notification = Notification::create([
            'sender' => $request->student_id,
            'recipient' => $request->tutor_id,
            'title' => 'New Trial lesson request' ,
            'body' => 'You have recieved a new student request. Please check you dashboard for more.',
            'status' => 'sent'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Trial lesson created',
            'data' =>true
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Update meeting link
     */
    public function updateMeetingLink(Request $request, $id ){
        $trial_lesson = TrialLesson::findOrFail($id);
        $trial_lesson->update([
            'meeting_link' => $request->meeting_link,
            'meeting_id' => $request->meeting_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'meeting link updated',
            'data' =>true
        ],200);
    }
}
