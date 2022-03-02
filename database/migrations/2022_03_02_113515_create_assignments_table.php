<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->integer('lesson_id')->required()->index();
            $table->integer('student_id')->required()->index();
            $table->integer('tutor_id')->required()->index();
            $table->integer('uploaded_by')->required()->index();
            $table->string('lesson_type')->required();
            $table->string('assignment_type')->required();
            $table->string('assignment_link')->required();
            $table->string('assignment_score')->nullable();
            $table->string('name')->nullable();

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
        Schema::dropIfExists('assignments');
    }
}
