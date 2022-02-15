<?php

namespace App\Http\Controllers\Api\Conversation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Conversation\ValidateConversation;
use App\Models\Conversation;
use App\Models\ConversationThread;

class ConversationController extends Controller
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
     * @param  \Illuminate\Http\Request\ValidateConversation  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateConversation $request)
    {
        $data = $request->validated();

        $conversation = Conversation::create($data); // save conversation

        $data['conversation_id'] = $conversation->id;
        $conversation_thread = ConversationThread::create($data); // start conversation thread

        return response()->json([
            'success' => true,
            'data' =>true,
            'message'=> 'Message sent successfully'
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
