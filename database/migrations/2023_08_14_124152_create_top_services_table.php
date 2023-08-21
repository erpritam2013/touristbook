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
        Schema::create('top_services', function (Blueprint $table) {
           $table->id();
             $table->string('name');
             $table->string('slug');
             $table->integer('parent_id')->default(0);
             $table->longText('description')->nullable();
             $table->string('icon')->nullable();
             $table->enum('top_service_type', config('global.post_types'));
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
        Schema::dropIfExists('top_services');
    }
};
