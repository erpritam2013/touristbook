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
        Schema::create('states', function (Blueprint $table) {
           $table->id();
             $table->string('name');
             $table->string('slug');
             $table->integer('parent_state')->default(0);
             $table->longText('description')->nullable();
             $table->string('icon')->nullable();
             $table->string('country',100)->nullable();
             $table->enum('state_type', config('global.post_types'));
             $table->longText('extra_data')->nullable();
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
        Schema::dropIfExists('states');
    }
};
