<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
           $table->string('full_name')->required();
           $table->string('first_name')->required();
           $table->string('middle_name')->nullable();
           $table->string('last_name')->required();
           $table->string('username')->nullable()->unique();
           $table->string('email')->requried();
           $table->string('role')->requried();
           $table->string('password')->requried();
           $table->string('phone')->nullable();
           $table->string('address')->nullable();
           $table->text('biography')->nullable();
           $table->string('id_number')->nullable();
           $table->dateTime('date_of_birth')->nullable();
           $table->string('city')->nullable();
           $table->string('country')->nullable();
           $table->string('nationality')->nullable();
           $table->string('postal_code')->nullable();
           $table->dateTime('phone_verified_at')->nullable();
           $table->dateTime('email_verified_at')->nullable();
           $table->dateTime('id_verified_at')->nullable();
           $table->dateTime('suspended_at')->nullable();
           $table->string('approved')->nullable();
           $table->dateTime('approved_at')->nullable();
           $table->dateTime('deleted_at')->nullable();
           $table->integer('approved_by')->nullable();
           $table->integer('registered_by')->nullable();
           $table->integer('suspended_by')->nullable();
           $table->string('reason_suspended')->nullable();
           $table->string('image')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
