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
        Schema::table('hotels', function (Blueprint $table) {
          
            $table->text('description')->nullable()->change();
            $table->text('external_link')->nullable()->change();
            $table->text('food_dining')->nullable()->change();
            $table->boolean('is_featured')->default(false)->change();
            $table->string('logo')->nullable()->change()->change();
            $table->string('featured_image')->nullable()->change();
            $table->string('hotel_video')->nullable()->change();
            $table->decimal('rating', 3, 2)->default(0)->change();
            $table->string('coupon_code')->nullable()->change();
            $table->json('hotel_attributes')->nullable()->change();
            $table->json('contact')->nullable()->change()->change();
            $table->decimal('avg_price', 10, 2)->default(0)->change();
            $table->boolean('is_allowed_full_day')->default(false)->change();
            // TODO: Rethink
            $table->dateTime('check_in')->nullable()->change();
            // TODO: Rethink
            $table->dateTime('check_out')->nullable()->change();
            $table->integer('book_before_day')->default(0)->change();
            $table->integer('book_before_arrival')->default(0)->change();
            $table->json('policies')->nullable()->change();
            $table->json('notices')->nullable()->change();
            $table->boolean('check_editing')->default(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hotels', function (Blueprint $table) {
            //
        });
    }
};
