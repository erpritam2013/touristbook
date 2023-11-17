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
        Schema::create('gallery_videos', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('video_gallery_id')->nullable();
            $table->longText('description')->nullable();
            $table->text('image_url')->nullable();
            $table->text('sl_url')->nullable();
            $table->string('sl_type')->nullable();
            $table->tinyInteger('link_target')->default(0)->nullable();
            $table->tinyInteger('ordering')->default(0)->nullable();
            $table->tinyInteger('published')->default(0)->nullable();
            $table->string('thumb_url')->nullable();
            $table->tinyInteger('show_controls')->default(0)->nullable();
            $table->tinyInteger('show_info')->default(0)->nullable();

            $table->foreign('video_gallery_id')->references('id')->on('video_galleries')->onDelete('cascade');

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
        Schema::dropIfExists('gallery_videos');
    }
};
