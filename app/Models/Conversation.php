<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Conversation extends Model
{
   use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     *
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        //
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        //
    ];

    // eloquent relation
     public function conversationThread(){
        return $this->hasmany(ConversationThread::class,'conversation_id', 'id');
    }

    // eloquent relation
     public function messageRecipient(){
        return $this->hasOne(User::class, 'id', 'recipient');
    }

    // eloquent relation
     public function messageSender(){
        return $this->hasOne(User::class, 'id','sender');
    }
}
