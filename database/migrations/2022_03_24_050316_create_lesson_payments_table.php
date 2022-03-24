<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('lesson_id')->required();
            $table->string('meeting_id')->required();
            $table->string('meeting_uuid')->nulable()->unique();
            $table->timestamp('meeting_started_at')->nullable();
            $table->timestamp('meeting_ended_at')->nullable();
            $table->timestamp('participant_joined_at')->nullable();
            $table->timestamp('participant_left_at')->nullable();
            $table->string('participant_left_reason')->nullable();
            $table->integer('meeting_duration')->nullable(); // minutes
            $table->tinyInteger('paid')->nullable(); 

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
        Schema::dropIfExists('lesson_payments');
    }
}
