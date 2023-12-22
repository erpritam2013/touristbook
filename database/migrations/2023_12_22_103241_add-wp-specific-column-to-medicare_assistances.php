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
        Schema::table('medicare_assistances', function (Blueprint $table) {
             $table->bigInteger('wp_term_id')->nullable();
            $table->bigInteger('wp_taxonomy_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicare_assistances', function (Blueprint $table) {
           $table->dropColumn(['wp_term_id', 'wp_taxonomy_id']);
        });
    }
};
