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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();

            $table->longText('description')->nullable();
            $table->text('excerpt')->nullable();
            $table->json('gallery')->nullable();
            $table->string('media')->nullable();
            $table->string('link')->nullable();

            $table->string('extra_price_unit')->nullable();
            $table->string('featured_image')->nullable();
            $table->BigInteger('featured_image_id')->default(0);
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
        Schema::dropIfExists('posts');
    }
};
