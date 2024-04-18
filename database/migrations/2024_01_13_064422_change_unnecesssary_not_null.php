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
           $table->json('tourism_zone')->nullable()->change();
        });
        Schema::table('country_zones', function (Blueprint $table) {
            $table->json('country_zone_section')->nullable()->change();
            $table->json('country_zone_catering')->nullable()->change();
        });
        Schema::table('activity_zones', function (Blueprint $table) {
           $table->json('activity_zone_section')->nullable()->change();
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
