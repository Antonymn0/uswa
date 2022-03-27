<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_accounts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->required()->index()->unique();
            $table->timestamp('date_created')->required();
            $table->double('balance_before')->required();
            $table->double('comission')->nullable();
            $table->double('available_balance')->required();
            $table->timestamp('last_transaction_date')->nullable();
            $table->double('last_amount_transacted')->nullable();
            $table->string('last_transaction_type')->nullable();
            $table->string('last_transaction_method')->nullable();

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
        Schema::dropIfExists('local_accounts');
    }
}
