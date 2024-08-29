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
        Schema::create('events', function (Blueprint $table) {
           $table->bigIncrements('id');
            $table->string('groom');
            $table->string('bride');
            $table->date('contract_date');
            $table->string('place_of_contract');
            $table->date('reception_date');
            $table->string('place_reception');
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
        Schema::dropIfExists('events');
    }
};
