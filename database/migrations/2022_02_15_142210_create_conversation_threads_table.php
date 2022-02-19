<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversationThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversation_threads', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('conversation_id')->unsigned()->required()->index(); // conversations table id 
            $table->integer('sender')->required()->index();  
            $table->integer('recipient')->required()->index(); 
            $table->text('message')->required();
            $table->timestamp('sent')->nullable();
            $table->timestamp('delivered')->nullable();
            $table->timestamp('seen')->nullable();

            $table->foreign('conversation_id')->references('id')->on('conversations')->onDelete('cascade');
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
        Schema::dropIfExists('conversation_threads');
    }
}
