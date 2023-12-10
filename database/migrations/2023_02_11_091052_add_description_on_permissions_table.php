<?php

use App\Enums\Table;
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
        Schema::table(Table::PERMISSIONS(), function (Blueprint $table) {
            $table->string("description")->nullable()->after("name");
            $table->string("feature")->nullable()->after("description");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(Table::PERMISSIONS(), function (Blueprint $table) {
            $table->dropColumn("description");
            $table->dropColumn("feature");
        });
    }
};
