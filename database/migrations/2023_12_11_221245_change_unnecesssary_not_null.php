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
            $table->json('location_content')->nullable()->change();
            $table->json('place_to_visit')->nullable()->change();
            $table->json('best_time_to_visit')->nullable()->change();
            $table->json('how_to_reach')->nullable()->change();
            $table->json('fair_and_festivals')->nullable()->change();
            $table->json('culinary_retreat')->nullable()->change();
            $table->json('shopaholics_anonymous')->nullable()->change();
            $table->json('weather')->nullable()->change();
            $table->json('location_map')->nullable()->change();
            $table->json('what_to_do')->nullable()->change();
            $table->json('get_to_know')->nullable()->change();
            $table->json('save_your_pocket')->nullable()->change();
            $table->json('save_your_environment')->nullable()->change();
            $table->json('faqs')->nullable()->change();
            $table->json('by_aggregators')->nullable()->change();
            $table->json('b_govt_subsidiaries')->nullable()->change();
            $table->json('by_hotels')->nullable()->change();
            $table->json('gallery')->nullable()->change();
            $table->json('location_video')->nullable()->change();
            $table->json('hotel_activities')->nullable()->change();
            $table->json('location_packages')->nullable()->change();
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
            //
        });
    }
};
