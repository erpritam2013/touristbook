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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('excerpt')->nullable();
            $table->text('external_link')->nullable();
            $table->text('address')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('sale_price', 10, 2)->default(0);
            $table->decimal('child_price', 10, 2)->default(0);
            $table->boolean('disable_children_name')->default(0);
            $table->boolean('hide_children_in_booking_form')->default(0);
            $table->json('discount_by_child')->nullable();
            $table->decimal('adult_price', 10, 2)->default(0);
            $table->boolean('hide_adult_in_booking_form')->default(0);
            $table->json('discount_by_adult')->nullable();
            $table->string('discount_by_people_type')->nullable();
            $table->string('calculator_discount_by_people_type')->nullable();
            $table->decimal('infant_price', 10, 2)->default(0);
            $table->boolean('disable_infant_name')->default(0);
            $table->boolean('hide_infant_in_booking_form')->default(0);

            $table->decimal('min_price', 10, 2)->default(0);
            $table->json('extra_price')->nullable();
            $table->boolean('st_activity_external_booking')->default(0);
            $table->string('st_activity_external_booking_link')->nullable();
            $table->string('deposit_payment_status')->nullable();
            $table->decimal('deposit_payment_amount', 10, 2)->nullable();
            $table->string('type_activity')->nullable();
           
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('activity_booking_period')->default(0);
            $table->integer('min_people')->default(0);
            $table->integer('max_people')->default(0);
            $table->string('duration')->nullable();
            $table->boolean('is_sale_schedule')->default(false);
            $table->integer('discount')->default(0);
            $table->dateTime('sale_price_from')->nullable();
            $table->dateTime('sale_price_to')->nullable();
            $table->string('discount_type')->nullable();
            $table->boolean('is_featured')->default(false);
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
        Schema::dropIfExists('activities');
    }
};
