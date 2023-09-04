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
        Schema::table('locations', function (Blueprint $table) {
            $table->string('name');
            $table->string('slug')->unique();
            // $table->bigInteger('user_id');
            $table->longText('description')->nullable();
            $table->text('excerpt')->nullable();
            $table->json('hotel_locations')->nullable();
            $table->integer('country')->nullable();
            $table->integer('zipcode')->nullable();
            $table->decimal('lat');
            $table->decimal('lng');
            $table->integer('map_zoom')->nullable();
            $table->string('map_type')->nullable();
            $table->text('address')->nullable();
            $table->json('location_content')->nullable();
            $table->longText('helpful_facts')->nullable();
            $table->json('place_to_visit')->nullable();
            $table->json('what_to_do')->nullable();
            $table->enum('stay', config('global.stay'))->nullable();
            $table->enum('packages', config('global.stay'))->nullable();
            $table->json('need_to_know')->nullable();
            $table->json('gallery')->nullable();
            $table->json('location_video')->nullable();
            $table->json('hotel_activities')->nullable();
            $table->json('location_packages')->nullable();
            $table->longText('important_note')->nullable();
            $table->longText('sanstive_data')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->bigInteger('parent_id')->default(0);
            $table->tinyInteger('menu_order')->default(0);
            $table->string('logo')->nullable();
            $table->string('featured_image')->nullable();
            
            // Location Created By
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');

            $table->tinyInteger('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->string('name');
            $table->string('slug');
            // $table->bigInteger('user_id');
            $table->longText('description');
            $table->text('excerpt');
            $table->json('hotel_locations');
            $table->integer('country');
            $table->integer('zipcode');
            $table->decimal('lat');
            $table->decimal('lng');
            $table->integer('map_zoom');
            $table->string('map_type');
            $table->text('address');
            $table->json('location_content');
            $table->longText('helpful_facts');
            $table->json('place_to_visit');
            $table->json('what_to_do');
            $table->enum('stay');
            $table->enum('packages');
            $table->json('need_to_know');
            $table->json('gallery');
            $table->json('location_video');
            $table->json('hotel_activities');
            $table->json('location_packages');
            $table->longText('important_note');
            $table->longText('sanstive_data');
            $table->boolean('is_featured');
            $table->bigInteger('parent_id');
            $table->tinyInteger('menu_order');
            $table->string('logo');
            $table->string('featured_image');
            $table->unsignedBigInteger('created_by');
            $table->tinyInteger('status');
            
        });
    }
};
