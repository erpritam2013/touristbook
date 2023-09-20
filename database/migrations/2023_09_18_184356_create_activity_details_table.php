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
        Schema::create('activity_details', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('activity_id');
          $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
          $table->string('map_address')->nullable();
          $table->decimal('latitude', 12, 9)->nullable();
          $table->decimal('longitude', 12, 9)->nullable();
          $table->unsignedInteger('zoom_level')->default(1);
          $table->boolean('enable_street_views_google_map')->default(0);
          $table->json('gallery')->nullable();
          $table->text('video')->nullable();
          $table->json('contact')->nullable();
          $table->text('venue_facilities')->nullable();
          $table->longText('activity_include')->nullable();
          $table->longText('activity_exclude')->nullable();
          $table->longText('activity_highlight')->nullable();
          $table->string('activity_program_style')->nullable();
          $table->json('activity_program')->nullable();
          $table->json('activity_faq')->nullable();
             // TODO: Calender For Availablity
          $table->dateTime('calendar_check_in')->nullable();
          $table->dateTime('calendar_check_out')->nullable();
          $table->decimal('calendar_adult_price', 10, 2)->default(0);
          $table->decimal('calendar_child_price', 10, 2)->default(0);
          $table->decimal('calendar_infant_price', 10, 2)->default(0);
          $table->json('calendar_starttime_hour')->nullable();
          $table->json('calendar_starttime_minute')->nullable();
          $table->json('calendar_starttime_format')->nullable();
          $table->string('calendar_status')->nullable();
          $table->boolean('calendar_groupday')->default(0);
            //Cancelation 
          $table->boolean('st_allow_cancel')->default(0);
          $table->integer('st_cancel_number_days')->default(0);
          $table->integer('st_cancel_percent')->default(0);
          $table->string('ical_url')->nullable();
          $table->boolean('is_meta_payment_gateway_st_submit_form')->default(0);
          $table->longText('child_policy')->nullable();
          $table->longText('booking_policy')->nullable();
          $table->longText('refund_and_cancellation_policy')->nullable();
          $table->string('country')->nullable();
          $table->unsignedBigInteger('activity_zone_id');
          $table->foreign('activity_zone_id')->references('id')->on('activity_zones')->onDelete('cascade');
          $table->string('st_activity_external_booking_link')->nullable();
          $table->json('activity_zones')->nullable();
          $table->string('st_activity_corporate_address')->nullable();
          $table->string('st_activity_short_address')->nullable();
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
        Schema::dropIfExists('activity_details');
    }
};
