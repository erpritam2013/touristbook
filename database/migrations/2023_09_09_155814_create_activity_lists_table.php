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
        Schema::create('activity_lists', function (Blueprint $table) {
          $table->id();

            $table->string('title');
            $table->longText('description')->nullable();
            $table->text('excerpt')->nullable();
            $table->string('slug')->unique();
            // $table->bigInteger('user_id');
            /*country zone tab */
            $table->string('custom_icon',10)->nullable();
            // $table->string('icon')->nullable();
            // $table->unsignedBigInteger('activity_id')->nullable();
            // $table->foreign('activity_id')->references('id')->on('activites')->onDelete('cascade');
            
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
        Schema::dropIfExists('activity_lists');
    }
};
