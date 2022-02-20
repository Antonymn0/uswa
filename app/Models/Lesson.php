<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     *
     */
    protected $guarded = ['id'];

    // eloquent relation
     public function getLessonTutor(){
        return $this->hasOne(User::class, 'id', 'tutor_id');
    }

    // eloquent relation
     public function getLessonStudent(){
        return $this->hasOne(User::class, 'id', 'student_id');
    }

}
