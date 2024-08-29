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
        Schema::create('headers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('event_title');
            $table->longText('welcome_text');
            $table->string('cover_overview');
            $table->string('cover_header');
            $table->date('event_start_date');

            $table->bigInteger('user_id')->unsigned()->default(0); // this is working
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('product_id')->unsigned()->default(0); // this is working
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->bigInteger('theme_id')->unsigned()->default(0); // this is working
            $table->foreign('theme_id')->references('id')->on('themes')->onDelete('cascade');

           

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
        Schema::dropIfExists('headers');
    }
};
