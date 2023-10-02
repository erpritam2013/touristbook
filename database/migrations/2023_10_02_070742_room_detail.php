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
         Schema::create('room_details', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('room_id');
          $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
          $table->json('gallery')->nullable();
          $table->text('video')->nullable();
          $table->string('room_facility_preview')->nullable();
          $table->unsignedBigInteger('room_facility_preview_id')->nullable();
          $table->foreign('room_facility_preview_id')->references('id')->on('media');
          $table->integer('adult_number')->nullable();
          $table->integer('children_number')->nullable();
          $table->integer('bed_number')->nullable();
          $table->integer('bath_number')->nullable();
          $table->string('room_footage')->nullable();

          $table->string('map_address')->nullable();
          $table->decimal('latitude', 12, 9)->nullable();
          $table->decimal('longitude', 12, 9)->nullable();
          $table->unsignedInteger('zoom_level')->default(1);
          $table->boolean('enable_street_views_google_map')->default(0);
          $table->json('contact')->nullable();
          $table->text('venue_facilities')->nullable();
          $table->longText('room_include')->nullable();
          $table->longText('room_exclude')->nullable();
          $table->longText('room_highlight')->nullable();
          $table->string('room_program_style')->nullable();
          $table->json('room_program')->nullable();
          $table->json('room_program_bgr')->nullable();
          $table->json('room_faq')->nullable();
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
          $table->unsignedBigInteger('room_zone_id');
          $table->foreign('room_zone_id')->references('id')->on('room_zones')->onDelete('cascade');
          $table->string('st_room_external_booking_link')->nullable();
          $table->json('room_zones')->nullable();
          $table->string('st_room_corporate_address')->nullable();
          $table->string('st_room_short_address')->nullable();
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
       Schema::dropIfExists('room_details');
    }
};
