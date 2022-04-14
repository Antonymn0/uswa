<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUswaCommisionAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uswa_commision_accounts', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('user_id')->required()->unique()->index(); // refferences users table
            $table->string('role')->required();
            $table->double('fee_percentage')->required();
            $table->double('available_balance')->required();
            $table->double('last_amount_transacted')->required();
            $table->string('last_transaction_type')->required();
            $table->double('balance_before')->required();
            $table->double('balance_after')->required();

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
        Schema::dropIfExists('uswa_commision_accounts');
    }
}
