<?php
// use Doctrine\DBAL\Types\{EnumType, Type};
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\{DB, Log};
return new class extends Migration
{

    //  public function __construct()
    // {
    //     try {
    //         Type::hasType('enum') ?: Type::addType('enum', StringType::class);
    //         // Type::hasType('timestamp') ?: Type::addType('timestamp', DateTimeType::class);
    //     } catch (\Exception $exception) {
    //         Log::info($exception->getMessage());
    //     }
    // }
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('pages', function (Blueprint $table) {
        //     $table->enum('type',config('global.page_types'))->nullable()->change();
           
        // });
        $implode_v = "'".implode("','", config('global.page_types'))."'";
           \DB::statement("ALTER TABLE `pages` CHANGE `type` `type` ENUM(".$implode_v.") NULL;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            //
        });
    }
};
