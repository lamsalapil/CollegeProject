<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schdules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bus_id');
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade');
            $table->dateTime('start_at');
            $table->unsignedBigInteger('start_destination_id');
            $table->foreign('start_destination_id')->references('id')->on('start_destination')->onDelete('cascade');
            
            $table->unsignedBigInteger('destination_id');
            $table->foreign('destination_id')->references('id')->on('destination')->onDelete('cascade');
            $table->dateTime('estimated_arrival_time');
            $table->float('distance');
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
        Schema::dropIfExists('schdules');
    }
};
