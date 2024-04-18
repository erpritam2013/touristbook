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
           // Hotel id 
           
            $table->string('name');
            $table->string('slug')->unique();

            $table->text('description')->nullable();
            $table->text('excerpt')->nullable();
            $table->text('address')->nullable();
            $table->decimal('price', 10, 2)->default(0)->nullable();
            $table->integer('number_room')->nullable();
            
            $table->integer('adult_number')->nullable();
            $table->integer('children_number')->nullable();
            $table->decimal('adult_price', 10, 2)->default(0)->nullable();
            $table->decimal('child_price', 10, 2)->default(0)->nullable();

            $table->json('extra_price')->nullable();
            $table->string('extra_price_unit')->nullable();
            $table->string('featured_image')->nullable();
            $table->unsignedBigInteger('featured_image_id')->nullable();
            $table->foreign('featured_image_id')->references('id')->on('media');
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
