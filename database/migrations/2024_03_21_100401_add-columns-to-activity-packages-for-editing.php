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
            $table->bigInteger('editor_id')->nullable();
            $table->dateTime('editing_expiry_time')->nullable();
            $table->boolean('is_editing')->default(false);
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
           $table->dropColumn(['editor_id', 'editing_expiry_time', 'is_editing']);
        });
    }
};
