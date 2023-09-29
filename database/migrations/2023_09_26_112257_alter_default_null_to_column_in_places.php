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
        $post_type = config('global.post_types');
        array_push($post_type, Null);
        Schema::table('places', function (Blueprint $table) use($post_type){
            $table->string('place_type')->default(Null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('places', function (Blueprint $table) {
            $table->enum('place_type', config('global.post_types'));
        });
    }
};
