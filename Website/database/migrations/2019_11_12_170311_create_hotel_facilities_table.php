<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_facilities', function (Blueprint $table) {
            $table->integer('hotelId');
            $table->boolean('breakfast');
            $table->boolean('24hrReception');
            $table->boolean('smoking');
            $table->boolean('freeWifi');
            $table->boolean('gymRoom');
            $table->boolean('freeParking');
            $table->boolean('petAllow');
            $table->boolean('swimmingPool');
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
        Schema::dropIfExists('hotel_facilities');
    }
}
