<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentCompletedLecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_completed_lectures', function (Blueprint $table) {
            $table->id();
            $table->integer('lesson_id')->required()->index();
            $table->integer('lecture_id')->required()->index();
            $table->integer('student_id')->required()->index();
            $table->integer('tutor_id')->required()->index();
            $table->integer('marked_by')->required()->index();
            $table->string('payment_status')->required()->index();
            $table->timestamp('payment_date')->nullable();
            $table->double('amount_due')->nullable();
            $table->double('paid_amount')->nullable();
            $table->string('payment_reciept_no')->nullable();  

            $table->tinyInteger('tutor_marked_complete')->nullable();
            $table->timestamp('tutor_marked_complete_at')->nullable();
            $table->tinyInteger('student_marked_complete')->nullable();
            $table->timestamp('student_marked_complete_at')->nullable();  
            
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
        Schema::dropIfExists('student_completed_lectures');
    }
}
