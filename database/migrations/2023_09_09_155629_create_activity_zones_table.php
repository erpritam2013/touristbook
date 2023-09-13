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
        Schema::create('activity_zones', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->longText('description')->nullable();
            $table->text('excerpt')->nullable();
            $table->string('slug')->unique();
            // $table->bigInteger('user_id');
            /*country zone tab */
            $table->string('sub_title');
            $table->string('country',10)->nullable();
            // $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->longText('activity_zone_description')->nullable();
            $table->json('activity_zone_section')->nullable();
            $table->string('activity_zone_pdf')->nullable();
            
            // Country Zone Created By
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('activity_zones');
    }
};
