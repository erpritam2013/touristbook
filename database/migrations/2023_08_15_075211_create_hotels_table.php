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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('external_link')->nullable();
            $table->text('food_dining')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->string('logo')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('hotel_video')->nullable();
            $table->decimal('rating', 3, 2)->default(0);
            $table->string('coupon_code')->nullable();
            $table->json('hotel_attributes');
            $table->decimal('avg_price', 10, 2);
            $table->boolean('is_allowed_full_day')->default(false);
            // TODO: Rethink
            $table->dateTime('check_in');
            // TODO: Rethink
            $table->dateTime('check_out');
            $table->integer('book_before_day');
            $table->integer('book_before_arrival');
            $table->json('policies');
            $table->json('notices');
            $table->boolean('check_editing')->default(false);
            
            // Hotel Created By
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');


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
        Schema::dropIfExists('hotels');
    }
};