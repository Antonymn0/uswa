<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->string('meeting_id')->nullable();
            $table->string('meeting_uuid')->nullable();
            $table->string('meeting_host_id')->nullable();
            $table->string('is_student_impressed')->nullable();
            $table->string('participant_left_meeting_reason')->nullable();
            
            $table->timestamp('meeting_started_at')->nullable();
            $table->timestamp('meeting_ended_at')->nullable();
            $table->timestamp('participant_joined_at')->nullable();
            $table->timestamp('participant_left_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lessons', function (Blueprint $table) {
            //
        });
    }
}
