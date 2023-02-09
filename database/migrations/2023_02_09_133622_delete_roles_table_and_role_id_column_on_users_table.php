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
        Schema::drop('roles');
        Schema::table("users", function (Blueprint $table) {
            $table->dropColumn("role_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 32);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table("users", function (Blueprint $table) {
            $table->unsignedBigInteger("role_id")->after("password");
        });
    }
};
