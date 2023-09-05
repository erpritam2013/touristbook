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
        Schema::create('hotel_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hotel_id');
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->string('map_address')->nullable();
            $table->decimal('latitude', 12, 9)->nullable();
            $table->decimal('longitude', 12, 9)->nullable();
            $table->unsignedInteger('zoom_level')->default(1);
            $table->json('highlights')->nullable();
            $table->json('facilityAmenities')->nullable();
            $table->json('foods')->nullable();
            $table->json('drinks')->nullable();
            $table->json('complimentary')->nullable();
            $table->json('helpfulfacts')->nullable();
            $table->string('save_pocket')->nullable();
            $table->json('pocketPDF')->nullable();
            $table->string('save_environment')->nullable();
            $table->json('landmark')->nullable();
            $table->json('todo')->nullable();
            $table->json('offers')->nullable();
            $table->json('todovideo')->nullable();
            $table->json('eventmeeting')->nullable();
            $table->string('tourism_zone')->nullable();
            $table->text('tourism_zone_heading')->nullable();
            $table->json('tourismzonepdf')->nullable();
            $table->json('activities')->nullable();
            $table->string('room_amenities')->nullable();
            $table->json('transport')->nullable();
            $table->text('payment_mode')->nullable();
            $table->string('id_proofs')->nullable();
            $table->json('emergencyLinks')->nullable();
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
        Schema::dropIfExists('hotel_details');
    }
};
