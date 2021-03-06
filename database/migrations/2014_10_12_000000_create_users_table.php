<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table)
        {
            $table->id();
            $table->string('login', 125);
            $table->string('password');

            $table->string('first_name', 255)->nullable();
            $table->string('last_name', 255)->nullable();

            $table->string('email', 255)->unique();
            $table->timestamp('email_verified_at')->nullable();

            $table->tinyInteger('status_id')->default(1);

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
