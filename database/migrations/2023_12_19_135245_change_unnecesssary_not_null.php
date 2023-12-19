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
        Schema::table('tour_details', function (Blueprint $table) {
            $table->string('map_address')->nullable()->change();
           $table->decimal('latitude', 12, 9)->nullable()->change();
           $table->decimal('longitude', 12, 9)->nullable()->change();
           $table->unsignedInteger('zoom_level')->default(1)->change();
           $table->boolean('enable_street_views_google_map')->default(0)->change();
           $table->boolean('is_iframe')->default(0)->change();
           $table->string('st_booking_option_type')->nullable()->change();
           $table->json('gallery')->nullable()->change();
           $table->text('video')->nullable()->change();
           $table->json('contact')->nullable()->change();
           $table->boolean('st_tour_external_booking')->default(0)->change();
           $table->string('st_tour_external_booking_link')->nullable()->change();
           $table->string('tours_coupan')->nullable()->change();
           $table->longText('tours_include')->nullable()->change();
           $table->longText('tours_exclude')->nullable()->change();
           $table->longText('tours_highlight')->nullable()->change();
           $table->json('tour_sponsored_by')->nullable()->change();
           $table->json('tours_destinations')->nullable()->change();
           $table->json('tour_helpful_facts')->nullable()->change();
           $table->string('tours_program_style')->nullable()->change();
           $table->json('tours_program')->nullable()->change();
           $table->json('tours_program_bgr')->nullable()->change();
           $table->json('tours_program_style4')->nullable()->change();
           $table->json('tours_faq')->nullable()->change();
           $table->string('st_tours_country')->nullable()->change();
           $table->json('package_route')->nullable()->change();
           $table->dateTime('calendar_check_in')->nullable()->change();
           $table->dateTime('calendar_check_out')->nullable()->change();
           $table->decimal('calendar_adult_price', 10, 2)->default(0)->change();
           $table->decimal('calendar_child_price', 10, 2)->default(0)->change();
           $table->decimal('calendar_infant_price', 10, 2)->default(0)->change();
           $table->string('calendar_starttime_hour')->nullable()->change();
           $table->string('calendar_starttime_minute')->nullable()->change();
           $table->string('calendar_starttime_format')->nullable()->change();
           $table->string('calendar_status')->nullable()->change();
           $table->boolean('calendar_groupday')->default(0)->change();
           $table->boolean('st_allow_cancel')->default(0)->change();
           $table->integer('st_cancel_number_days')->default(0)->change();
           $table->integer('st_cancel_percent')->default(0)->change();
           $table->string('ical_url')->nullable()->change();
           $table->boolean('is_meta_payment_gateway_st_submit_form')->default(0)->change();
           $table->longText('helpful_facts')->nullable()->change();
           $table->json('sponsored')->nullable()->change();



           $table->json('social_links')->nullable()->change();
           $table->json('properties_near_by')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tour_details', function (Blueprint $table) {
            //
        });
    }
};
