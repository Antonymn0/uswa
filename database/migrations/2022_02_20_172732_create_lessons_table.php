<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->required()->index(); // student user id 
            $table->integer('tutor_id')->required()->index(); // tutor user id 
            $table->integer('trial_lesson_id')->required()->unique()->index(); // trial lesson id 

            $table->string('lesson_total_duration')->nullable(); 
            $table->dateTime('lessons_start_date')->nullable();
            $table->dateTime('lessons_end_date')->nullable();
            $table->dateTime('next_lesson_date')->nullable();
            $table->dateTime('previous_lesson_date')->nullable(); 

            $table->integer('covered_duration')->nullable(); 
            $table->integer('remaining_duration')->nullable();
            $table->string('start_time')->nullable(); 
            $table->string('end_time')->nullable(); 

            $table->string('lesson_type')->nullable(); 
            $table->string('tutor_confirm')->nullable(); 
            $table->string('student_confirm')->nullable(); 

            $table->string('tutor_timezone')->nullable(); 
            $table->string('student_timezone')->nullable(); 
            $table->string('decline_reason')->nullable();

            $table->string('postponed')->nullable(); 
            $table->string('postponed_to')->nullable(); 
            $table->string('postponed_reason')->nullable(); 
            
            $table->string('student_score')->nullable();
            $table->integer('previous_lecture')->nullable(); 
            $table->integer('current_lecture')->nullable(); 
            $table->integer('next_lecture')->nullable(); 

            $table->string('student_remarks')->nullable(); 
            $table->string('tutor_remarks')->nullable(); 
            $table->string('status')->nullable(); 
            $table->string('meeting_link')->nullable(); 

            $table->string('meeting_id')->nullable();
            $table->string('meeting_uuid')->nullable();
            $table->string('meeting_host_id')->nullable();
            $table->string('is_student_impressed')->nullable();
            $table->string('participant_left_meeting_reason')->nullable();
            
            $table->timestamp('meeting_started_at')->nullable();
            $table->timestamp('meeting_ended_at')->nullable();
            $table->timestamp('participant_joined_at')->nullable();
            $table->timestamp('participant_left_at')->nullable();

            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
