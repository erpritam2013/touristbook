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
            $table->dropColumn(['location_content', 'helpful_facts', 'place_to_visit', 'what_to_do', 'need_to_know', 'gallery', 'location_video', 'hotel_activities', 'location_packages', 'important_note', 'sanstive_data']);
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

            $table->json('location_content')->nullable();
            $table->longText('helpful_facts')->nullable();
            $table->json('place_to_visit')->nullable();
            $table->json('what_to_do')->nullable();
            $table->json('need_to_know')->nullable();
            $table->json('gallery')->nullable();
            $table->json('location_video')->nullable();
            $table->json('hotel_activities')->nullable();
            $table->json('location_packages')->nullable();
            $table->longText('important_note')->nullable();
            $table->longText('sanstive_data')->nullable();
            
        });
    }
};
