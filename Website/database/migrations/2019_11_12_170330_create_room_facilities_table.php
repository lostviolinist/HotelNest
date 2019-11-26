<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_facilities', function (Blueprint $table) {
            $table->integer('hotelId');
            $table->integer('roomId');
            $table->boolean('airConditioning');
            $table->boolean('bathtub');
            $table->boolean('TV');
            $table->boolean('refrigerator');
            $table->boolean('freeToiletries');
            $table->boolean('toilet');
            $table->boolean('fan');
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
        Schema::dropIfExists('room_facilities');
    }
}
