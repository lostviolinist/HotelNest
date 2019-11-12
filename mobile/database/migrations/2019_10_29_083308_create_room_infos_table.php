<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_infos', function (Blueprint $table) {
            $table->bigIncrements('roomId');
            $table->string('type');
            $table->double('price');
            $table->integer('pax');
            $table->string('description');
            $table->boolean('addBed');
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
        Schema::dropIfExists('room_infos');
    }
}
