<?php

namespace App\Http\Controllers\Api\LessonPayment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LessonPayment;

class LessonPaymentController extends Controller
{
    /**
     * | This controller manages zoom meetings time/duration for effective account billing.
     */
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lesson_payments = LessonPayment::paginate(env('API_PAGINATION', 10));
        return response()->json([
            'success'=> true,
            'message' => 'A list of lesson payments',
            'data'=>$lesson_payments
            ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $data = $request;
        $lesson_payment = LessonPayment::create($data);

        return response()->json([
            'success'=> true,
            'message'=> 'Lesson payment created successfuly',
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
        $lesson_payment = LessonPayment::findOrFail($id);
        return response()->json([
            'success'=> true,
            'message'=> 'Á single lesson payment retrieved successfully', 
            'data'=>$lesson], 200);
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
        $data = $request;
        $lesson_payment = LessonPayment::findOrFail($id);

        $lesson_payment->update($data);

        return response()->json([
            'success'=> true,
            'message'=> 'Lesson payment updated successfully', 
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
        $lesson_payment = LessonPayment::findOrFail($id)->delete();
        return response()->json([
            'success'=> true, 
            'message'=> 'lesson payment deleted successfuly', 
            'data'=>true], 200);
    }
}
