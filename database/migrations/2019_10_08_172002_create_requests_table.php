<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status');
            $table->string('type');
            $table->string('ref')->nullable();
            $table->text('data')->nullable();
            $table->text('follow_link')->nullable();
            $table->text('link')->nullable();
            $table->string('number');
            $table->string('amount');
            $table->bigInteger('user_id');
            $table->bigInteger('vehicle_id');
            $table->bigInteger('parking_space_id');
            $table->dateTime('end')->nullable();
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
        Schema::dropIfExists('requests');
    }
}
