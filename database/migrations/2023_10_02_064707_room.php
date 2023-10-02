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
        Schema::create('rooms', function (Blueprint $table) {
           $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('excerpt')->nullable();
            $table->text('address')->nullable();
            $table->integer('number_room')->nullable();
            $table->boolean('hotel_alone_room_layout')->default(0);
            $table->string('hotel_alone_room_sub_heading')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('sale_price', 10, 2)->default(0);
            $table->decimal('child_price', 10, 2)->default(0);
            $table->boolean('disable_children_name')->default(0);
            $table->boolean('hide_children_in_booking_form')->default(0);
            $table->json('discount_by_child')->default(0);
            $table->decimal('adult_price', 10, 2)->default(0);
            $table->boolean('hide_adult_in_booking_form')->default(0);
            $table->json('discount_by_adult')->default(0);
            $table->string('discount_by_people_type')->nullable();
            $table->string('calculator_discount_by_people_type')->nullable();
            

            $table->decimal('min_price', 10, 2)->default(0);
            $table->json('extra_price')->nullable();
            $table->boolean('st_room_external_booking')->default(0);
            $table->string('st_room_external_booking_link')->nullable();

            $table->boolean('allow_full_day')->default(0);
            $table->string('deposit_payment_status')->nullable();
            $table->decimal('deposit_payment_amount', 10, 2)->nullable();

             $table->json('discount_by_day')->nullable();
             $table->string('discount_type_no_day')->nullable();
            $table->string('type_room')->nullable();
           
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('room_booking_period')->default(0);
            $table->integer('min_people')->default(0);
            $table->integer('max_people')->default(0);
            $table->string('duration')->nullable();
            $table->boolean('is_sale_schedule')->default(false);
            $table->integer('discount')->default(0);
            $table->dateTime('sale_price_from')->nullable();
            $table->dateTime('sale_price_to')->nullable();
            $table->string('discount_type')->nullable();
            $table->boolean('is_featured')->default(false);
             $table->string('st_booking_option_type',100)->nullable();
            $table->string('logo')->nullable();
            $table->string('featured_image')->nullable();
           
            
            // Hotel Created By
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');

            $table->tinyInteger('status')->default(0);
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
       Schema::dropIfExists('rooms');
    }
};
