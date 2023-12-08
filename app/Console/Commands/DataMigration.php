<?php

namespace App\Console\Commands;

use App\Models\Tour;
use App\Models\User;
use App\Models\Location;
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
        if(isset($data[$key])) {
            return $data[$key];
        }
        return "";
    }


    /**
     * Truncating Tables
     */
    public function truncate_tables() {
        $tables = ['users', 'tours','locations'];
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

    public function tourist_is_serialized( $data, $strict = true ) {
        // If it isn't a string, it isn't serialized.
        if ( ! is_string( $data ) ) {
            return false;
        }
        $data = trim( $data );
        if ( 'N;' === $data ) {
            return true;
        }
        if ( strlen( $data ) < 4 ) {
            return false;
        }
        if ( ':' !== $data[1] ) {
            return false;
        }
        if ( $strict ) {
            $lastc = substr( $data, -1 );
            if ( ';' !== $lastc && '}' !== $lastc ) {
                return false;
            }
        } else {
            $semicolon = strpos( $data, ';' );
            $brace     = strpos( $data, '}' );
            // Either ; or } must exist.
            if ( false === $semicolon && false === $brace ) {
                return false;
            }
            // But neither must be in the first X characters.
            if ( false !== $semicolon && $semicolon < 3 ) {
                return false;
            }
            if ( false !== $brace && $brace < 4 ) {
                return false;
            }
        }
        $token = $data[0];
        switch ( $token ) {
            case 's':
                if ( $strict ) {
                    if ( '"' !== substr( $data, -2, 1 ) ) {
                        return false;
                    }
                } elseif ( ! str_contains( $data, '"' ) ) {
                    return false;
                }
                // Or else fall through.
            case 'a':
            case 'O':
            case 'E':
                return (bool) preg_match( "/^{$token}:[0-9]+:/s", $data );
            case 'b':
            case 'i':
            case 'd':
                $end = $strict ? '$' : '';
                return (bool) preg_match( "/^{$token}:[0-9.E+-]+;$end/", $data );
        }
        return false;
    }

    public function unserialize_data_format_in_array($value,$field="")
    {
        $result = [];
        if ($this->tourist_is_serialized($value)) {
            
            $get_unserialized_value = unserialize($value);
            if (!empty($field)) {

                if (is_array($get_unserialized_value)) {
                    // $final_result = [];

                    // $collect = collect($get_unserialized_value);

           
                    foreach ($get_unserialized_value as $key => $value) {
                        foreach ($value as $k => $v) { 
                          $result[$key][$field.'-'.$k] = $v;
                        }
                    }

                    // $result = $collect->each(function($items,int $key) use($field,&$result){
                    //        return collect($items)->each(function($item,$k) use ($field,$result,$key){
                    //     dd($field);
                    //          $new_key = $field.'-'.$k;
                    //            return $result[$key][$new_key] = $item;

                    //        });
                           
                    //        // foreach ($items as $k => $v) {
                    //        //  $new_key = $field.'-'.$k;
                    //        //     $result[$key][$new_key] = $v;
                    //        // }
                           
                    // });
                    //      return $result->toArray();
                }
            }else{
               $result = $get_unserialized_value;
            }
        }

        return $result;
    }

    /**
     * Tour Module
     */
    public function tour_migrate() {
        $this->info("Tour Data Loading...");
        DB::connection($this->wp_connection)->table('wp_posts as p')
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
            ->orderBy('p.ID', 'desc')
            ->chunk(30, function ($results) {
                // Build 500 Objects
                $nestedResults = [];

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

                    $nestedResults[$postId]['postmeta'][$metaKey] = $metaValue;
                }

                // TODO: Can think better way
                // One more iteration for Laravel Specific
                $tours = collect([]);
                if(!empty($nestedResults)) {
                    foreach($nestedResults as $postId => $n_result) {
                        $tour = [
                            "wp_id" => $postId,
                            "name" => $n_result["post_title"],
                            "slug" => Str::slug($n_result["post_title"], '-'),
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
                            "extra_price" => $this->unserialize_data_format_in_array($this->get_key_data($n_result["postmeta"], "extra_price"),"extra_price"),
                            "created_at" => $n_result["post_date_gmt"],
                            "country_zone_id" => $this->get_key_data($n_result["postmeta"], "st_country_zone_id"),
                            "tour_price_by" => $this->get_key_data($n_result["postmeta"], "tour_price_by")

                        ];

                        $tours->push($tour);


                    }

                    Tour::insert($tours->toArray());
                }





            });




        $this->info("Tour Data Loading Completed");
    }


    /**
     * location Module
     */
    public function location_migrate() {
        $this->info("Location Data Loading...");
         $results = DB::connection($this->wp_connection)->table('wp_posts as p')
        ->select('p.*', 'pm.*')
        ->join('wp_postmeta as pm', 'pm.post_id', '=', 'p.ID')
        ->whereIn('pm.meta_key', ["color","location_country","zipcode","map_lat","map_lng","map_zoom","map_type","is_featured","_thumbnail_id"])
        ->where('p.post_type', 'location')
        ->where('p.post_status', 'publish')
        ->orderBy('p.ID', 'desc')

        ->get();


                // Build 500 Objects
            $nestedResults = [];

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

                    $nestedResults[$postId]['postmeta'][$metaKey] = $metaValue;
                }

                // TODO: Can think better way
                // One more iteration for Laravel Specific
                $locations = collect([]);
                if(!empty($nestedResults)) {
                    foreach($nestedResults as $postId => $n_result) {
                        $location = [
                            "wp_id" => $postId,
                            "name" => $n_result["post_title"],
                            "color" => $this->get_key_data($n_result["postmeta"], "color"),
                            "slug" => $n_result["post_name"],
                            "description" => $n_result["post_content"],
                            "excerpt" => $n_result["post_excerpt"], 
                            "country" => $this->get_key_data($n_result["postmeta"], "location_country"),
                            "zipcode" => $this->get_key_data($n_result["postmeta"], "zipcode"),
                            "latitude" => $this->get_key_data($n_result["postmeta"], "map_lat"),
                            "longitude" => $this->get_key_data($n_result["postmeta"], "map_lng"),
                            "zoom_level" => $this->get_key_data($n_result["postmeta"], "map_zoom"),
                            "map_type" => $this->get_key_data($n_result["postmeta"], "map_type"),
                            "map_address" => "",
                            "is_featured" => $this->get_key_data($n_result["postmeta"], "is_featured"),
                            "parent_id" => $n_result["post_parent"],
                            "menu_order" => $n_result["menu_order"],
                            "logo" => $this->get_key_data($n_result["postmeta"], "logo"),
                            "featured_image" => $this->get_key_data($n_result["postmeta"], "_thumbnail_id"),
                            "status" => 1,

                        ];

                        $locations->push($location);


                    }

                    Location::insert($locations->toArray());
                }





         
        $this->info("Location Data Loading Completed");
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
        $this->user_migrate();
        // Tour Module
       $this->tour_migrate();
        // Location Module
        $this->location_migrate();

       return Command::SUCCESS;
    }
}
