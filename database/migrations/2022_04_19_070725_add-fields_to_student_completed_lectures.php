<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToStudentCompletedLectures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_completed_lectures', function (Blueprint $table) {
            $table->tinyInteger('tutor_marked_complete')->nullable();
            $table->timestamp('tutor_marked_complete_at')->nullable();
            $table->tinyInteger('student_marked_complete')->nullable();
            $table->timestamp('student_marked_complete_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_completed_lectures', function (Blueprint $table) {
            //
        });
    }
}
