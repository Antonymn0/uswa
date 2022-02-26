<?php

namespace App\Http\Controllers\Api\VideoStream;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Pusher\Pusher;
// use App\Models\User;

class VideoStreamController extends Controller
{    
    // authenticate video streaming on pusher
    public function auth(Request $request) {
        $user = $request->user();
        $socket_id = $request->socket_id;
        $channel_name = $request->channel_name;
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            config('broadcasting.connections.pusher.options'),
            [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'encrypted' => true
            ]
        );
        return response(
            $pusher->presence_auth($channel_name, $socket_id, $user->id)
        );
    }
}
