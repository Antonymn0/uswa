<?php

namespace App\Http\Controllers\Api\Conversation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Conversation\ValidateConversation;
use App\Models\Conversation;
use App\Models\ConversationThread;
use App\Models\User;

class ConversationController extends Controller
{
    /**
     * get student messages.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStudentMessages(Request $request)
    {
        $user = $request->user();
        $messages = Conversation::with('conversationThread')
                    ->with('messageRecipient')
                    ->where('sender', $user->id)
                    ->orWhere('recipient', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(env('API_PAGINATION', 10));
        return response()->json([
            'success' => true,
            'data' =>$messages,
            'message'=> 'A list of messages'
        ], 200);
    }

    /**
     *get tutor messages.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTutorMessages(Request $request)
    {
        $user = $request->user();
        $messages = Conversation::with('conversationThread')
                    ->with('messageSender')
                    ->where('sender', $user->id)
                    ->orWhere('recipient', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(env('API_PAGINATION', 10));
        return response()->json([
            'success' => true,
            'data' =>$messages,
            'message'=> 'A list of messages'
        ], 200);
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
        $data['student_seen'] = 1;   //set seen status to true

        $conversation = Conversation::create($data); // save conversation

        $data['conversation_id'] = $conversation->id;
        $conversation_thread = ConversationThread::create($data); // start conversation thread

        return response()->json([
            'success' => true,
            'data' =>true,
            'message'=> 'Conversation started successfully'
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
        $message = Conversation::with('conversationThread')
                            ->where('id', $id)
                            ->first();
        return response()->json([
            'success' => true,
            'data' =>$message,
            'message'=> 'Conversation thread fetched successfully'
        ], 200);
    }

   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {        
       $conversation = Conversation::findOrFail($id);
       $conversation->delete();
       return response()->json([
            'success' => true,
            'data' =>$conversation,
            'message'=> 'Conversation thread deleted successfully'
        ], 200);
    }

    /**
     * update conversation  seen
     */
    public function updateSeen(request $request, $id){
        
        $conversation = Conversation::findOrfail($id);
        $user = $request->user();

        if($user->role == 'student')$conversation->update(['student_seen' => 1, ]);
        if($user->role == 'tutor')$conversation->update(['tutor_seen' => 1, ]);
        
        return response()->json([
            'success' => true,
            'data' =>true,
            'message'=> 'Conversation seen status updated.'
        ], 200);
    }

}
