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
        Schema::table('activity_details', function (Blueprint $table) {
            $table->dropForeign('activity_details_activity_zone_id_foreign');
            $table->dropColumn('activity_zone_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activity_details', function (Blueprint $table) {
            $table->unsignedBigInteger('activity_zone_id');
          $table->foreign('activity_zone_id')->references('id')->on('activity_zones')->onDelete('cascade');
        });
    }
};
