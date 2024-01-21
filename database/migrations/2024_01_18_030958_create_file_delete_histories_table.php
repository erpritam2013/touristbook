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
        Schema::create('file_delete_histories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('file_name')->nullable();
            $table->text('path')->nullable();
            $table->dateTime('created_date')->nullable();
            $table->string('mime_type')->nullable();
            $table->json('generated_conversions')->nullable();
            $table->bigInteger('file_id');
            $table->bigInteger('media_id');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('file_delete_histories');
    }
};
