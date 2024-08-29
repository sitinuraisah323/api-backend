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
      Schema::create('guests', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('name');
        $table->string('status');
        $table->bigInteger('total');
        $table->string('reason');
        $table->string('label');
        $table->bigInteger('user_id')->unsigned()->nullable(); // this is working
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('guests');
    }
};
