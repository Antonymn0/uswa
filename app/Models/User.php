<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Conversation;
use App\Models\TrialLesson;
use App\Models\Review;
class User extends Authenticatable
{
    use HasApiTokens; 
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

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
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // eloquent relation
     public function tutorSchedule(){
        return $this->hasOne(TutorSchedule::class,'user_id', 'id');
    }

    // eloquent relation
     public function trialLesson(){
        return $this->hasMany(TrialLesson::class,'user_id', 'id');
    }

    // eloquent relation
     public function getLesson(){
        return $this->hasMany(Lesson::class,'user_id', 'id');
    }

    // eloquent relation
     public function reviews(){
        return $this->hasMany(Review::class,'reviewee_id', 'id');
    }

   
}
