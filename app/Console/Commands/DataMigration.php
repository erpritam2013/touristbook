<?php

namespace App\Console\Commands;

use App\Models\Tour;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DataMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data-migration-tool:migrate {is_fresh=false}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Data Migration tool';

    protected $wp_connection = 'wordpress_sql';


    /**
     * Isset Utility
     */
    function get_key_data($data, $key) {
        if(isset($data[$key]) && !empty($data[$key]) && !is_null($data[$key])) {
            return $data[$key];
        }
        return "0";
    }


    /**
     * Truncating Tables
     */
    public function truncate_tables() {
        $tables = ['users', 'tours'];
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        foreach($tables as $table) {
            DB::table($table)->truncate();
        }
    }

    /**
     * User Module
     */
    public function user_migrate() {
        $this->info("User Data Loading...");
        // Fetch Wordpress Data
        $usersWithCapabilities = DB::connection($this->wp_connection)
            ->table('wp_users')
            ->join('wp_usermeta', function ($join) {
                $join->on('wp_users.ID', '=', 'wp_usermeta.user_id')
                    ->where('wp_usermeta.meta_key', '=', 'wp_capabilities');
            })
            ->select('wp_users.*', 'wp_usermeta.meta_value as capabilities')
            ->get();

        $users = collect([]);
        if($usersWithCapabilities->isNotEmpty()) {
            foreach($usersWithCapabilities as $wp_user) {
                $capabilities = unserialize($wp_user->capabilities);
                $user = new User([
                    'wp_id' => $wp_user->ID,
                    'name' => $wp_user->display_name,
                    'email' => $wp_user->user_email,
                    'password' => Hash::make('password'),
                    'created_at' => $wp_user->user_registered,
                    'updated_at' => $wp_user->user_registered,
                    'is_active' => '1',
                    'role' => collect($capabilities)->keys()->first(),
                ]);
                $users->push($user);
            }
        }

        if($users->isNotEmpty()) {
            User::insert($users->toArray());
        }

        $this->info("User Data Loading Completed");

    }

    /**
     * Tour Module
     */
    public function tour_migrate() {
        $this->info("Tour Data Loading...");

        $post_collections = DB::connection($this->wp_connection)->table("wp_st_tours")->select("post_id")->get();
        $postIds = $post_collections->pluck('post_id')->toArray();

        foreach(array_chunk($postIds, 200) as $pIds) {

            $pQuery = DB::connection($this->wp_connection)->table('wp_posts as p')
                ->select('p.*', 'pm.*', 'wp_st_tours.*')
                ->leftJoin("wp_st_tours", "wp_st_tours.post_id", '=', 'p.ID')
                ->join('wp_postmeta as pm', 'pm.post_id', '=', 'p.ID')
                ->whereIn('pm.meta_key', [
                    'st_tour_external_booking_link', 'tour_price_by', 'min_people',
                    '_thumbnail_id', 'discount_type', 'discount_by_child', 'discount_by_adult',
                    'discount_by_people_type', 'calculator_discount_by_people_type',
                    'hide_adult_in_booking_form', 'hide_children_in_booking_form',
                    'hide_infant_in_booking_form', 'disable_adult_name', 'disable_children_name',
                    'disable_infant_name', 'extra_price', 'st_country_zone_id', 'tour_price_by'
                ])
                ->where('p.post_type', 'st_tours')
                ->where('p.post_status', 'publish')
                ->whereIn('p.ID', $pIds)
                ->orderBy('p.ID', 'desc');

            $results = $pQuery->get();

            $nestedResults = [];
            $serializer_fields = ['discount_by_child'];

            foreach ($results as $result) {
                $postId = $result->ID;
                unset($result->ID); // Remove the ID field from the main post data

                if (!isset($nestedResults[$postId])) {
                    $nestedResults[$postId] = (array) $result;
                    $nestedResults[$postId]['postmeta'] = [];
                }

                $metaKey = $result->meta_key;
                $metaValue = $result->meta_value;

                unset($result->meta_key, $result->meta_value); // Remove meta_key and meta_value fields

                if(in_array($metaKey, $serializer_fields)) {
                    // Serialized Results
                    $nestedResults[$postId]['postmeta'][$metaKey] = 'Serialized Result';
                }else {
                    $nestedResults[$postId]['postmeta'][$metaKey] = $metaValue;
                }

            }


            // TODO: Can think better way
            // One more iteration for Laravel Specific
            $tours = collect([]);
            if(!empty($nestedResults)) {
                foreach($nestedResults as $postId => $n_result) {
                    $tour = [
                        "wp_id" => $postId,
                        "name" => $n_result["post_title"],
                        "slug" => $n_result["post_name"],
                        "description" => $n_result["post_content"],
                        "excerpt" => $n_result["post_excerpt"],
                        "external_link" => $this->get_key_data($n_result["postmeta"], "st_tour_external_booking_link"),
                        "address" => $n_result["address"],
                        "tour_price_by" => $this->get_key_data($n_result["postmeta"], "tour_price_by"),
                        "sale_price" => $n_result["sale_price"],
                        "child_price" => $n_result["child_price"],
                        "adult_price" => $n_result["adult_price"],
                        "infant_price" => $n_result["infant_price"],
                        "min_price" => $n_result["min_price"],
                        "min_people" => $this->get_key_data($n_result["postmeta"], "min_people"),
                        "max_people" => $n_result["max_people"],
                        "type_tour" => $n_result["type_tour"],
                        "rate_review" => $n_result["rate_review"],
                        "duration_day" => $n_result["duration_day"],
                        "tours_booking_period" => $n_result["tours_booking_period"],
                        "is_sale_schedule" => $n_result["is_sale_schedule"],
                        "discount" => $n_result["discount"],
                        "sale_price_from" => $n_result["sale_price_from"],
                        "sale_price_to" => $n_result["sale_price_to"],
                        "is_featured" => $n_result["is_featured"],
                        "featured_image" => $this->get_key_data($n_result["postmeta"], "_thumbnail_id"),
                        "discount_type" => $this->get_key_data($n_result["postmeta"], "discount_type"),
                        "discount_by_child" => $this->get_key_data($n_result["postmeta"], "discount_by_child"),
                        "discount_by_adult" => $this->get_key_data($n_result["postmeta"], "discount_by_adult"),
                        "discount_by_people_type" => $this->get_key_data($n_result["postmeta"], "discount_by_people_type"),
                        "calculator_discount_by_people_type" => $this->get_key_data($n_result["postmeta"], "calculator_discount_by_people_type"),
                        "hide_adult_in_booking_form" => $this->get_key_data($n_result["postmeta"], "hide_adult_in_booking_form"),
                        "hide_children_in_booking_form" => $this->get_key_data($n_result["postmeta"], "hide_children_in_booking_form"),
                        "hide_infant_in_booking_form" => $this->get_key_data($n_result["postmeta"], "hide_infant_in_booking_form"),
                        "disable_adult_name" => $this->get_key_data($n_result["postmeta"], "disable_adult_name"),
                        "disable_children_name" => $this->get_key_data($n_result["postmeta"], "disable_children_name"),
                        "disable_infant_name" => $this->get_key_data($n_result["postmeta"], "disable_infant_name"),
                        "extra_price" => $this->get_key_data($n_result["postmeta"], "extra_price"),
                        "created_at" => $n_result["post_date_gmt"],
                        "country_zone_id" => $this->get_key_data($n_result["postmeta"], "st_country_zone_id"),
                        "tour_price_by" => $this->get_key_data($n_result["postmeta"], "tour_price_by")

                    ];

                    $tours->push($tour);


                }

                Tour::insert($tours->toArray());
            }



        }


        // TODO: Tour Details


        $this->info("Tour Data Loading Completed");
    }



    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("Migration Started......");

        $isFresh = $this->argument('is_fresh');

        // Truncating Tables
        if($isFresh == "clean") {
            $this->info("Truncating tables...");
            $this->truncate_tables();
            $this->info("Table Truncated...");
        }

        // User Module
        // $this->user_migrate();

        // Tour Module
        $this->tour_migrate();






        return Command::SUCCESS;
    }
}
