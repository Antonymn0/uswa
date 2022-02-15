<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorShedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutor_schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->required()->index(); // references users table
            $table->string('monday')->nullable(); 
            $table->string('monday_from')->nullable(); 
            $table->string('monday_to')->nullable(); 

            $table->string('tuesday')->nullable(); 
            $table->string('tuesday_from')->nullable(); 
            $table->string('tuesday_to')->nullable(); 

            $table->string('wednesday')->nullable(); 
            $table->string('wednesday_from')->nullable(); 
            $table->string('wednesday_to')->nullable(); 

            $table->string('thursday')->nullable(); 
            $table->string('thursday_from')->nullable(); 
            $table->string('thursday_to')->nullable(); 

            $table->string('friday')->nullable(); 
            $table->string('friday_from')->nullable(); 
            $table->string('friday_to')->nullable(); 

            $table->string('saturday')->nullable(); 
            $table->string('saturday_from')->nullable(); 
            $table->string('saturday_to')->nullable(); 

            $table->string('sunday')->nullable(); 
            $table->string('sunday_from')->nullable(); 
            $table->string('sunday_to')->nullable(); 


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
        Schema::dropIfExists('tutor_shedules');
    }
}
