<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaceRatings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_ratings', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('place_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->tinyInteger('rating')->default(0);

            $table->timestamps();

            $table->foreign('place_id')->references('id')->on('places');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('place_ratings');
    }
}
