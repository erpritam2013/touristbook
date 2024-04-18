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
        Schema::create('location_meta', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->json('location_content')->nullable();
            $table->longText('helpful_facts')->nullable();
            $table->json('place_to_visit')->nullable();
            $table->text('place_to_visit_description')->nullable();
            $table->json('best_time_to_visit')->nullable();
            $table->text('best_time_to_visit_description')->nullable();
            $table->json('how_to_reach')->nullable();
            $table->text('how_to_reach_description')->nullable();
            $table->json('fair_and_festivals')->nullable();
            $table->string('fair_and_festivals_image')->nullable();
            $table->text('fair_and_festivals_description')->nullable();
            $table->json('culinary_retreat')->nullable();
            $table->text('culinary_retreat_description')->nullable();
            $table->json('shopaholics_anonymous')->nullable();
            $table->text('shopaholics_anonymous_description')->nullable();
            $table->json('weather')->nullable();
            $table->json('location_map')->nullable();
            $table->json('what_to_do')->nullable();
            $table->json('get_to_know')->nullable();
            $table->string('get_to_know_image')->nullable();
            $table->json('save_your_pocket')->nullable();
            $table->string('save_your_pocket_image')->nullable();
            $table->json('save_your_environment')->nullable();
            $table->string('save_your_environment_image')->nullable();
            // $table->jsfon('need_to_know')->nullable();
            $table->json('faqs')->nullable();
            $table->json('by_aggregators')->nullable();
            $table->json('b_govt_subsidiaries')->nullable();
            $table->json('by_hotels')->nullable();
            $table->json('gallery')->nullable();
            $table->json('location_video')->nullable();
            $table->json('hotel_activities')->nullable();
            $table->json('location_packages')->nullable();
            $table->longText('important_note')->nullable();
            $table->longText('sanstive_data')->nullable();
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
        Schema::table('location_meta', function (Blueprint $table) {
           Schema::dropIfExists('location_meta');
        });
    }
};
