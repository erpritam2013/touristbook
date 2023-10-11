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
        Schema::table('room_details', function (Blueprint $table) {
          $table->dropForeign('room_details_room_facility_preview_id_foreign');
            $table->dropColumn('room_facility_preview_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('room_details', function (Blueprint $table) {
            $table->unsignedBigInteger('room_facility_preview_id');
          $table->foreign('room_facility_preview_id')->references('id')->on('media');
        });
    }
};
