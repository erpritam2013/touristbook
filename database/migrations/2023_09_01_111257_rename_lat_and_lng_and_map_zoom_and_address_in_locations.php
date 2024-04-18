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
        Schema::table('locations', function (Blueprint $table) {
            $table->renameColumn('lat', 'latitude');
            $table->renameColumn('lng', 'longitude');
            $table->renameColumn('map_zoom', 'zoom_level');
            $table->renameColumn('address', 'map_address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->renameColumn('latitude', 'lat');
            $table->renameColumn('longitude', 'lng');
            $table->renameColumn('zoom_level', 'map_zoom');
            $table->renameColumn('map_address', 'address');
        });
    }
};
