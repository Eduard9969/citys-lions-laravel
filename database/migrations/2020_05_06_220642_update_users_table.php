<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table((new \App\Http\Models\User())->getTable(), function (Blueprint $table) {
            $table->string('avatar_alias', 255)->nullable()->after('email_verified_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table((new \App\Http\Models\User())->getTable(), function (Blueprint $table) {
            $table->removeColumn('avatar_alias');
        });
    }
}
