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
        Schema::table('comments', function (Blueprint $table) {
            
            $table->enum('model_type',['Hotel','Tour','Activity','Post'])->after('model_id')->nullable();
            $table->bigInteger('parent_id')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
         $table->dropColumn('model_type');
         $table->dropColumn('parent_id');
         $table->dropColumn('delete_at');

        });
    }
};
