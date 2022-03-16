<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable()->index();
            $table->string('transaction_id')->required()->unique(); // reciept number
            $table->string('transaction_type')->required(); 
            $table->string('payment_method')->required();
            $table->double('amount_transacted')->required();
            $table->string('transacted_from')->required();   // from where ? payer_id
            $table->string('transacted_to')->required();     //  to where?  merchant_id
            $table->double('commision_charged')->nullable();
            $table->double('balance_before')->required();
            $table->double('balance_after')->required();
            $table->timestamp('transaction_date')->required();
            $table->text('remarks')->nullable();

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
        Schema::dropIfExists('transaction_histories');
    }
}
