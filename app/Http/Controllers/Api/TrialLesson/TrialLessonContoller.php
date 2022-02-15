<?php

namespace App\Http\Controllers\Api\TrialLesson;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrialLesson;
use App\Http\Requests\TrialLesson\ValidateTrialLesson;

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
        $trialLesson = TrialLesson::create($data);
        return $trialLesson;
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
}
