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
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn(['stay', 'packages', 'filter_add', 'color', 'hotel_locations']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->enum('stay', config('global.stay'))->nullable();
            $table->enum('packages', config('global.stay'))->nullable();
            $table->json('filter_add')->nullable();
            $table->string('color')->nullable();
            $table->json('hotel_locations')->nullable();
        });
    }
};
