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
        Schema::create('tour_details', function (Blueprint $table) {
           $table->id();
           $table->unsignedBigInteger('tour_id')->nullable();
           $table->foreign('tour_id')->references('id')->on('tours')->onDelete('cascade');
           $table->string('map_address')->nullable();
           $table->decimal('latitude', 12, 9)->nullable();
           $table->decimal('longitude', 12, 9)->nullable();
           $table->unsignedInteger('zoom_level')->default(1);
           $table->boolean('enable_street_views_google_map')->default(0);
           $table->boolean('is_iframe')->default(0);
           $table->string('st_booking_option_type')->nullable();
           $table->json('gallery')->nullable();
           $table->text('video')->nullable();
           $table->json('contact')->nullable();
           $table->boolean('st_tour_external_booking')->default(0);
           $table->string('st_tour_external_booking_link')->nullable();
           $table->string('tours_coupan')->nullable();
           $table->longText('tours_include')->nullable();
           $table->longText('tours_exclude')->nullable();
           $table->longText('tours_highlight')->nullable();
           $table->json('tour_sponsored_by')->nullable();
           $table->json('tours_destinations')->nullable();
           $table->json('tour_helpful_facts')->nullable();
           $table->string('tours_program_style')->nullable();
           $table->json('tours_program')->nullable();
           $table->json('tours_program_bgr')->nullable();
           $table->json('tours_program_style4')->nullable();
           $table->json('tours_faq')->nullable();
           $table->string('st_tours_country')->nullable();
           $table->json('package_route')->nullable();
           $table->dateTime('calendar_check_in')->nullable();
           $table->dateTime('calendar_check_out')->nullable();
           $table->decimal('calendar_adult_price', 10, 2)->default(0);
           $table->decimal('calendar_child_price', 10, 2)->default(0);
           $table->decimal('calendar_infant_price', 10, 2)->default(0);
           $table->string('calendar_starttime_hour')->nullable();
           $table->string('calendar_starttime_minute')->nullable();
           $table->string('calendar_starttime_format')->nullable();
           $table->string('calendar_status')->nullable();
           $table->boolean('calendar_groupday')->default(0);
           $table->boolean('st_allow_cancel')->default(0);
           $table->integer('st_cancel_number_days')->default(0);
           $table->integer('st_cancel_percent')->default(0);
           $table->string('ical_url')->nullable();
           $table->boolean('is_meta_payment_gateway_st_submit_form')->default(0);
           $table->longText('helpful_facts')->nullable();
           $table->json('sponsored')->nullable();



           $table->json('social_links')->nullable();
           $table->json('properties_near_by')->nullable();
           $table->boolean('check_editing')->default(false);
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
        Schema::dropIfExists('tour_details');
    }
};
