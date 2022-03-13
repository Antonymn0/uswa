<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaypalAuthTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paypal_auth_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('provider')->required();
            $table->string('app_id')->required();
            $table->text('token')->required();
            $table->string('token_type')->nullable();
            $table->integer('expires_in')->nullable();
            $table->string('nonce')->nullable();
            $table->text('scope')->nullable();

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
        Schema::dropIfExists('paypal_auth_tokens');
    }
}
