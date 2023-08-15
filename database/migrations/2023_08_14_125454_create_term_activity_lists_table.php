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
        Schema::create('term_activity_lists', function (Blueprint $table) {
            $table->id();
             $table->string('name');
             $table->string('slug');
             $table->integer('parent_term_activity_list')->default(0);
             $table->longText('description')->nullable();
             $table->string('icon')->nullable();
             $table->enum('term_activity_list_type', config('global.post_types'));
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
        Schema::dropIfExists('term_activity_lists');
    }
};
