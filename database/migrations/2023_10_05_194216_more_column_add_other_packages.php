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
        Schema::table('other_packages', function (Blueprint $table) {
             $table->tinyInteger('button')->default(0)->after('slug');
             $table->json('extra_data')->nullable()->after('other_package_type');
             $table->string('country')->nullable()->after('other_package_type');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('other_packages', function (Blueprint $table) {
           $table->dropColumn('button');
           $table->dropColumn('extra_data');
           $table->dropColumn('country');
        });
    }
};
