<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrialLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trial_lessons', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->required()->index(); // student user id 
            $table->integer('tutor_id')->required()->index(); // tutor user id 
            $table->dateTime('lesson_date')->required(); 
            $table->string('start_time')->required(); 
            $table->string('lesson_type')->required(); 
            $table->string('end_time')->nullable(); 
            $table->string('tutor_confirm')->nullable(); 
            $table->string('tutor_timezone')->nullable(); 
            $table->string('student_timezone')->nullable(); 
            $table->string('decline_reason')->nullable(); 
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
        Schema::dropIfExists('trial_lessons');
    }
}
