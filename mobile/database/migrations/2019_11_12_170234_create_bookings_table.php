<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('bookingNum');
            $table->string('fullName');
            $table->string('email');
            $table->string('phone');
            $table->string('icNum');
            $table->date('checkInDate');
            $table->date('checkOutDate');
            $table->string('remark');
            $table->integer('adult');
            $table->integer('child');
            $table->double('totalPrice');
            $table->integer('roomId');
            $table->integer('hotelId');
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
        Schema::dropIfExists('bookings');
    }
}
