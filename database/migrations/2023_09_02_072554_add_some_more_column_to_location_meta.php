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
        Schema::table('location_meta', function (Blueprint $table) {
           $table->enum('stay', config('global.stay'))->after('sanstive_data')->nullable();
            $table->enum('packages', config('global.stay'))->after('sanstive_data')->nullable();
            $table->json('location_for_filter')->after('sanstive_data')->nullable();
            $table->string('color')->after('sanstive_data')->nullable();
            $table->json('hotel_locations')->after('sanstive_data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('location_meta', function (Blueprint $table) {
            $table->enum('stay');
            $table->enum('packages');
            $table->json('location_for_filter');
            $table->string('color');
            $table->json('hotel_locations');
        });
    }
};
