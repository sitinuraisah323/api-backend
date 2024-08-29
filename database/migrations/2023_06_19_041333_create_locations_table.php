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
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('event_name');
            $table->date('event_date');
            $table->string('location_name');
            $table->string('location_address');
            $table->string('location_image');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);

            $table->bigInteger('header_id')->unsigned()->nullable();
            $table->foreign('header_id')->references('id')->on('headers')->onDelete('cascade');
            
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
        Schema::dropIfExists('locations');
    }
};
