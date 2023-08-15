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
        Schema::create('facilities', function (Blueprint $table) {
             $table->id();
             $table->string('name');
             $table->string('slug');
             $table->integer('parent_facility')->default(0);
             $table->longText('description')->nullable();
             $table->string('icon')->nullable();
             $table->enum('facility_type', config('global.post_types'));
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
        Schema::dropIfExists('facilities');
    }
};