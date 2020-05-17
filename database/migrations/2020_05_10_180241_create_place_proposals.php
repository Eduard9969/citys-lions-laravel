<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaceProposals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_proposals', function (Blueprint $table) {
            $table->id();

            $table->integer('place_id')->nullable(true);
            $table->bigInteger('user_id')->unsigned();
            $table->string('name', 255);
            $table->text('description');
            $table->string('features', 255)->nullable(true);
            $table->tinyInteger('status_id')->default(0);

            $table->timestamps();

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
        Schema::dropIfExists('place_proposals');
    }
}
