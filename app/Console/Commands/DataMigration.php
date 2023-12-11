<?php

namespace App\Console\Commands;

use App\Models\Tour;
use App\Models\User;
use App\Models\Location;
use App\Models\LocationMeta;
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
        $tables = ['users', 'tours','locations','location_meta'];
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
                   // $result = json_encode($result);
              }
          }else{
           $result = $get_unserialized_value;
       }
   }
   if (!empty($result)) {

    return $result;
}else{
    $result = "[]";
}
}


public function comma_saprated_to_array($value,$type='')
{
  $result = [];
  if (!empty($value)) {
      $result = explode(',', $value);
  }

  if (!empty($type)) {
     if ($type == 'gallery') {
        $galleries = [];
        foreach ($result as $k => $v) {
            $test['id'] = $v;
            $galleries[] = $test;
        }
        $result = $galleries;
    }
}
if (!empty($result)) {

    return $result;
}else{
    $result = "";
}
}
public function find_image_id($string)
{
   $id = '';
   if (!empty($string)) {

   }
   return $id;
}
public function string_to_json($string,$type='')
{
   $result = [];
   if (!empty($string)) {
       if ($type == 'image') {
        $convert_string_1 = str_replace('https://touristbook.s3.ap-south-1.amazonaws.com/', '', $string);
        $convert_string_2 = str_replace('https://test.thetouristbook.com/', '', $convert_string_1);
        $convert_string_3 = str_replace('https://test-touristbook.com/', '', $convert_string_2);
        $media = DB::connection($this->wp_connection)->table('wp_as3cf_items as s3_image')
        ->where('path','like',$convert_string_3)
        ->select('s3_image.*')

        ->first();
        $test['id'] = $media->source_id;
        $test['url'] = $string;
        $result[] = $test;
        $result = json_encode($result);

    }
}
if (!empty($result)) {

    return $result;
}else{
    $result = "";
}

}
public function radio_value_modify($value)
{
    $result = 0;
    if (!empty($value) && $value == 'on') {
       $result = 1;
   }
   return $result;
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
                            "created_at"=>$n_result["post_date_gmt"],
                            "updated_at"=>$n_result["post_modified"]

                        ];

                        $locations->push($location);


                    }
                     //dd($locations->toArray());
                    Location::insert($locations->toArray());
                }



                $this->info("Location Data Loading Completed");
            }

     /**
     * location Meta Module
     */
     public function location_meta_migrate() {
        $this->info("Location Meta Data Loading...");
        $results = DB::connection($this->wp_connection)->table('wp_posts as p')
        ->select('p.ID as ID', 'pm.*')
        ->join('wp_postmeta as pm', 'pm.post_id', '=', 'p.ID')
        ->whereIn('pm.meta_key', ["helpful_facts","place_to_visit","place_to_visit_description","best_time_to_visit","best_time_to_visit_description","how_to_reach","how_to_reach_description","fair_and_festivals","fair_and_festivals_image","fair_and_festivals_description","culinary_retreat","culinary_retreat_description","shopaholics_anonymous","shopaholics_anonymous_description","weather","location_map","what_to_do","get_to_know","get_to_know_image","save_your_pocket","save_your_pocket_image","save_your_environment","save_your_environment_image","faqs","by_aggregators","b_govt_subsidiaries","by_hotels","gallery","location_video","hotel_activities","location_packages","important_note","sanstive_data","hotel_locations","color","location_for_filter",])
        ->where('p.post_type', 'location')
        ->where('p.post_status', 'publish')
        ->orderBy('p.ID', 'desc')

        ->get();
    //dd($results[0]);
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
                $location_metas = collect([]);
                if(!empty($nestedResults)) {
                    foreach($nestedResults as $postId => $n_result) {

                        $location_content = [ 
                            'st_location_use_build_layout'=>$this->radio_value_modify($this->get_key_data($n_result["postmeta"], "st_location_use_build_layout")), 
                            'is_gallery'=> $this->radio_value_modify($this->get_key_data($n_result["postmeta"], "location_tab_item")),
                            'location_gallery_style'=>$this->get_key_data($n_result["postmeta"], "location_gallery_style"), 
                            'image_count'=>$this->get_key_data($n_result["postmeta"], "image_count"), 
                            'st_gallery'=>$this->comma_saprated_to_array($this->get_key_data($n_result["postmeta"], "st_gallery"),'gallery'), 
                            'is_tabs'=>$this->radio_value_modify($this->get_key_data($n_result["postmeta"], "is_tabs")), 
                            'tab_position'=>$this->get_key_data($n_result["postmeta"], "location_tab_item"), 
                            'location_tab_item'=> $this->unserialize_data_format_in_array($this->get_key_data($n_result["postmeta"], "location_tab_item"))

                        ];
                        $location_data = Location::where('wp_id',$postId)->first();
                        $location_meta = [
                            "location_id" => $location_data->id,
                            "location_content" => $location_content,
                            "helpful_facts" => $this->get_key_data($n_result["postmeta"], "helpful_facts"), 
                            "place_to_visit" => $this->unserialize_data_format_in_array($this->get_key_data($n_result["postmeta"], "place_to_visit"),'place_to_visit'), 
                            "place_to_visit_description" => $this->get_key_data($n_result["postmeta"], "place_to_visit_description"), 
                            "best_time_to_visit" => $this->unserialize_data_format_in_array($this->get_key_data($n_result["postmeta"], "best_time_to_visit"), "best_time_to_visit"), 
                            "best_time_to_visit_description" => $this->get_key_data($n_result["postmeta"], "best_time_to_visit_description"), 
                            "how_to_reach" => $this->unserialize_data_format_in_array($this->get_key_data($n_result["postmeta"], "how_to_reach"), "how_to_reach"), 
                            "how_to_reach_description" => $this->get_key_data($n_result["postmeta"], "how_to_reach_description"), 
                            "fair_and_festivals" => $this->unserialize_data_format_in_array($this->get_key_data($n_result["postmeta"], "fair_and_festivals"), "fair_and_festivals"), 
                            "fair_and_festivals_image" => $this->string_to_json($this->get_key_data($n_result["postmeta"], "fair_and_festivals_image"),'image'),  
                            "fair_and_festivals_description" => $this->get_key_data($n_result["postmeta"], "fair_and_festivals_description"), 
                            "culinary_retreat" => $this->unserialize_data_format_in_array($this->get_key_data($n_result["postmeta"], "culinary_retreat"), "culinary_retreat"), 
                            "culinary_retreat_description" => $this->get_key_data($n_result["postmeta"], "culinary_retreat_description"), 
                            "shopaholics_anonymous" => $this->unserialize_data_format_in_array($this->get_key_data($n_result["postmeta"], "shopaholics_anonymous"), "shopaholics_anonymous"), 
                            "shopaholics_anonymous_description" => $this->get_key_data($n_result["postmeta"], "shopaholics_anonymous_description"), 
                            "weather" => $this->unserialize_data_format_in_array($this->get_key_data($n_result["postmeta"], "weather")), 
                            "location_map" => $this->unserialize_data_format_in_array($this->get_key_data($n_result["postmeta"], "location_map"), "location_map"), 
                            "what_to_do" => $this->unserialize_data_format_in_array($this->get_key_data($n_result["postmeta"], "what_to_do"), "what_to_do"), 
                            "get_to_know" => $this->unserialize_data_format_in_array($this->get_key_data($n_result["postmeta"], "get_to_know"), "get_to_know"), 
                            "get_to_know_image" =>  $this->string_to_json($this->get_key_data($n_result["postmeta"], "get_to_know_image"),'image'), 
                            "save_your_pocket" => $this->unserialize_data_format_in_array($this->get_key_data($n_result["postmeta"], "save_your_pocket"), "save_your_pocket"), 
                            "save_your_pocket_image" => $this->string_to_json($this->get_key_data($n_result["postmeta"], "save_your_pocket_image"),'image'), 
                            "save_your_environment" => $this->unserialize_data_format_in_array($this->get_key_data($n_result["postmeta"], "save_your_environment"), "save_your_environment"), 
                            "save_your_environment_image" => $this->string_to_json($this->get_key_data($n_result["postmeta"], "save_your_environment_image"),'image'), 
                            "faqs" => $this->unserialize_data_format_in_array($this->get_key_data($n_result["postmeta"], "faqs"), "faqs"), 
                            "by_aggregators" => $this->unserialize_data_format_in_array($this->get_key_data($n_result["postmeta"], "by_aggregators"), "by_aggregators"), 
                            "b_govt_subsidiaries" => $this->unserialize_data_format_in_array($this->get_key_data($n_result["postmeta"], "b_govt_subsidiaries"), "b_govt_subsidiaries"), 
                            "by_hotels" => $this->unserialize_data_format_in_array($this->get_key_data($n_result["postmeta"], "by_hotels"), "by_hotels"), 
                            "gallery" => $this->comma_saprated_to_array($this->get_key_data($n_result["postmeta"], "gallery"),'gallery'), 
                            "location_video" => [], 
                            "hotel_activities" => $this->unserialize_data_format_in_array($this->get_key_data($n_result["postmeta"], "by_hotels"), "hotel_activities"),  
                            "location_packages" => "", 
                            "important_note" => $this->get_key_data($n_result["postmeta"], "important_note"), 
                            "sanstive_data" => $this->get_key_data($n_result["postmeta"], "sanstive_data"), 
                            // "hotel_locations" => $this->get_key_data($n_result["postmeta"], "hotel_locations"), 
                            "color" => $this->get_key_data($n_result["postmeta"], "color"), 
                            "location_for_filter" => $this->unserialize_data_format_in_array($this->get_key_data($n_result["postmeta"], "location_for_filter"), "location_for_filter"), 
                            'packages'=>'tour',
                            'stay'=>'hotel',
                            'child_tabs'=>""

                        ];

                        $location_metas->push($location_meta);


                    }
                    
                    LocationMeta::insert($location_metas->toArray());
                }






                $this->info("Location Meta Data Loading Completed");
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
        //$this->tour_migrate();
        // Location Module
        $this->location_migrate();

         // Location Meta Module
    $this->location_meta_migrate();

        return Command::SUCCESS;

    }
}
