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
        Schema::table('tourism_zones', function (Blueprint $table) {
            $table->string('sub_title')->nullable()->change();
        });
        Schema::table('activity_zones', function (Blueprint $table) {
            $table->string('sub_title')->nullable()->change();
        });
        Schema::table('country_zones', function (Blueprint $table) {
            $table->string('sub_title')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tourism_zones', function (Blueprint $table) {
            //
        });
    }
};
