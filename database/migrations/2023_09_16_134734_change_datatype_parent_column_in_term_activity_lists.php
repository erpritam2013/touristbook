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
        if (Schema::hasColumn('term_activity_lists', 'parent')) {
        Schema::table('term_activity_lists', function (Blueprint $table) {
            $table->string('parent')->default(Null)->change();
        });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Schema::hasColumn('term_activity_lists', 'parent_id')) {
            Schema::table('term_activity_lists', function (Blueprint $table) {
            $table->integer('parent_id')->default(0)->change();
        });
        }
        
    }
};
