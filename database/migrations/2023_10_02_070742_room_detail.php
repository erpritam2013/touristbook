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
          $table->boolean('hotel_alone_room_layout')->default(0)->nullable();
          $table->string('hotel_alone_room_sub_heading')->nullable();

          $table->boolean('price_by_per_person')->default(0)->nullable();
          $table->string('st_booking_option_type',100)->nullable();

          $table->boolean('allow_full_day')->default(0)->nullable();
          $table->string('discount_rate')->nullable();
          $table->json('discount_by_day')->nullable();
          $table->string('discount_type_no_day')->nullable();
          $table->string('discount_type')->nullable();
          $table->string('deposit_payment_status')->nullable();
          $table->decimal('deposit_payment_amount', 10, 2)->nullable();

          $table->json('gallery')->nullable();
          $table->text('video')->nullable();
          $table->string('room_facility_preview')->nullable();
          $table->unsignedBigInteger('room_facility_preview_id')->nullable();
          $table->foreign('room_facility_preview_id')->references('id')->on('media');

          $table->boolean('disable_adult_name')->default(0)->nullable();
          $table->boolean('disable_children_name')->default(0)->nullable();

          $table->integer('bed_number')->nullable();
          $table->integer('bath_number')->nullable();
          $table->string('room_footage')->nullable();
          $table->boolean('st_room_external_booking')->default(0)->nullable();
          $table->string('st_room_external_booking_link')->nullable();

          $table->json('add_new_facility')->nullable();
          $table->longText('room_description')->nullable();

          $table->string('defaulte_status')->nullable();
          $table->dateTime('calendar_check_in')->nullable();
          $table->dateTime('calendar_check_out')->nullable();
          $table->decimal('calendar_price', 10, 2)->default(0)->nullable();
          $table->string('calendar_status')->nullable();
            //Cancelation 
          $table->boolean('st_allow_cancel')->default(0)->nullable();
          $table->integer('st_cancel_number_days')->default(0)->nullable();
          $table->integer('st_cancel_percent')->default(0)->nullable();
          $table->string('ical_url')->nullable();
          $table->boolean('is_meta_payment_gateway_st_submit_form')->default(0);

          $table->json('social_links')->nullable();
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
