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
        Schema::table('activity_packages', function (Blueprint $table) {
            $table->string('custom_icon',100)->nullable()->change();
        });
        Schema::table('activity_lists', function (Blueprint $table) {
            $table->string('custom_icon',100)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activity_packages', function (Blueprint $table) {
            //
        });
    }
};
