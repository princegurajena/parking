<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParkingSpacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parking_spaces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status')->default('active');
            $table->string('lat');
            $table->string('long');
            $table->string('name')->nullable();
            $table->string('road')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('country')->nullable();
            $table->dateTime('reserved')->nullable();
            $table->bigInteger('reserved_user_id')->nullable();
            $table->bigInteger('vehicle_id')->nullable();
            $table->dateTime('occupied')->nullable();
            $table->integer('rate')->nullable();
            $table->bigInteger('occupied_user_id')->nullable();

            // Nice to have

            $table->string('top_right')->nullable();
            $table->string('top_left')->nullable();
            $table->string('bottom_left')->nullable();
            $table->string('bottom_right')->nullable();


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
        Schema::dropIfExists('parking_spaces');
    }
}
