<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LessonPayment;
use App\Models\Lecture;
use App\Models\StudentCompletedLecture;

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

    // eloquent relation
     public function getAssignments(){
        return $this->hasMany(Assignment::class, 'lesson_id', 'id');
    }

    // eloquent relation
    public function meetings(){
        return $this->hasMany(LessonPayment::class,'lesson_id', 'id');
    }

    // eloquent relation
    public function lectures(){
        return $this->hasMany(Lecture::class,'tutor_id', 'tutor_id');
    }

    // eloquent relation
    public function completedLectures(){
        return $this->hasMany(StudentCompletedLecture::class,'student_id', 'student_id');
    }

}
