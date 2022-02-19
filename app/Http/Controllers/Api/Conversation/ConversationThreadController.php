<?php

namespace App\Http\Controllers\Api\Conversation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ConversationThread;
use App\Http\Requests\Conversation\ValidateConversationThread;

class ConversationThreadController extends Controller
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
     * @param  \Illuminate\Http\Request\ValidateConversationThread  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateConversationThread $request)
    {
        $data = $request->validated();

        $message = ConversationThread::create($data); // create message

        return response()->json([
            'success' => true,
            'data' =>true,
            'message'=> 'Reply sent successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
