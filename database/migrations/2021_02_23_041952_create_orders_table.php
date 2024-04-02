<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('room_number')->nullable();
            $table->integer('total_qty');
            $table->integer('subtotal');
            $table->integer('tax');
            $table->integer('service');
            $table->integer('total');
            $table->integer('payment_status');
            $table->integer('order_status');
            $table->string('session');
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
        Schema::dropIfExists('orders');
    }
}
