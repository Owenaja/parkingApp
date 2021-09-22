<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('slot_id')->nullable();
            $table->string('lisence_number');
            $table->integer('duration')->nullable();
            $table->dateTime('time_in')->nullable();
            $table->dateTime('real_time_in')->nullable();
            $table->dateTime('time_out')->nullable();
            $table->dateTime('real_time_out')->nullable();
            $table->enum('status', ['0', '1'])->default('0');
            $table->integer('total_price')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('slot_id')->references('id')->on('parking_slots');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}