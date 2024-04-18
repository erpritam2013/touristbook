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
        Schema::table('location_types', function (Blueprint $table) {

            $table->dropColumn(['name', 'slug', 'parent_id', 'description', 'icon', 'location_type', 'label_type', 'status','created_at','updated_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('location_types', function (Blueprint $table) {
             $table->string('name');
             $table->string('slug');
             $table->integer('parent_id')->default(0);
             $table->longText('description')->nullable();
             $table->string('icon')->nullable();
             $table->enum('location_type', config('global.post_types'));
             $table->enum('label_type', config('global.lebal_types'))->nullable();
             $table->tinyInteger('status')->default(1);
             $table->timestamps();
        });
    }
};
