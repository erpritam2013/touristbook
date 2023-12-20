<?php

namespace App\Console\Commands;

use App\Models\Tour;
use App\Models\User;
use App\Models\File;
use App\Models\Media;
use App\Models\Location;
use App\Models\CountryZone;
use App\Models\LocationMeta;
use App\Models\Terms\Type;
use App\Models\Terms\PackageType;
use App\Models\Terms\OtherPackage;
use App\Models\Terms\State;
use App\Models\Terms\Language;
use App\Models\TourLanguage;
use App\Models\TourLocation;
use App\Models\ActivityLanguage;
use App\Models\TourDetail;
use App\Models\TourType;

use App\Models\TourPackageType;
use App\Models\TourState;
use App\Models\TourOtherPackage;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use tehwave\Shortcodes\Shortcode;
use App\Shortcodes\origincode_videogallery;

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

    protected $tour_package_type = [
      'Tour' => [
        "column" => 'package-type',
        "laravel_table" => 'tour_package_types'
    ],
];  
protected $tour_other_package = [
  'Tour' => [
    "column" => 'other-packages',
    "laravel_table" => 'tour_other_packages'
],
];

protected $term_category_dictionary = [
    'Tour' => [
        "column" => 'st_tour_type',
        "laravel_table" => 'tour_types'
    ],
    'Room' => [
        "column" => 'room_type',
        "laravel_table" => 'room_types'
    ],
    'Location' => [
        "column" => 'st_location_type',
        "laravel_table" => 'location_types'
    ],
];

    /**
     * Isset Utility
     */
    function get_key_data($data, $key) {
        if(isset($data[$key]) && !empty($data[$key]) && !is_null($data[$key])) {
            return $data[$key];
        }
        return null;
    }


    /**
     * Truncating Tables
     */

    public function truncate_tables(array $tables) {
        //$tables = ['users','tours','locations','location_meta','country_zones'];

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

        $result = "";
        if (!empty($value)) {

            if ($this->tourist_is_serialized($value)) {


                $get_unserialized_value = unserialize($value);
                if (!empty($field)) {

                    if (is_array($get_unserialized_value)) {
                        $result = [];
                    // $final_result = [];

                    // $collect = collect($get_unserialized_value);
                        $image_keys = ['video_thumbnail','image'];
                        foreach ($get_unserialized_value as $key => $value) {
                            foreach ($value as $k => $v) {
                              if (in_array($k,$image_keys)) {
                                $result[$key][$field.'-'.$k] = $this->string_to_json($v,'image');
                            }else{
                              $result[$key][$field.'-'.$k] = $v;



                          }

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
                  $result = json_encode($result);
              }
          }else{

             $result = json_encode($get_unserialized_value);
         }
     }
 }

 if (!empty($result)) {

    return $result;
}else{

    $result = "[]";
    return $result;
}
}

public function media_sizes($value)
{
    $result = "";
    if (!empty($value)) {
        $result = [];
        $json_decode = json_decode($value,true);
        if (!empty($json_decode) && is_array($json_decode)) {
            if (isset($json_decode['sizes'])) {

                $sizes = $json_decode['sizes'];
                if (count($sizes) > 0) {
                 foreach ($sizes as $key => $size) {
                    if ($key == 'thumbnail') {
                     $result[$key] = true;
                 }else{
                   if (isset($size['width']) && isset($size['height'])) {
                     $temp_key = $size['width'].'x'.$size['height'];
                     $result[$temp_key] = true;
                 }
             }
         }
         $result = json_encode($result);

     }
 }

}

}
if (!empty($result)) {

    return $result;
}else{

    $result = "[]";
    return $result;
}
}

public function set_image_date($value)
{
    $result = date('Y-m-d h:i:s');
    if (!empty($value)) {
       $data_convert_array = explode('/', $value);
       $year_month = $data_convert_array[0].'-'.$data_convert_array[1];
       $date=date_create($year_month);
       $date_format = date_format($date,"Y-m-d h:i:s");
       $result = $date_format;
   }
   return $result;
}

public function get_image_name($value,$type="")
{
    $result = "";
    if (!empty($type)) {
        if ($type == 'image') {
            $data_convert_array = explode('/', $value);
            $result = $data_convert_array[2];
        }
    }else{
        $str_replace = str_replace('_', '-', $value);
        $result = $str_replace;
    }
    return $result;
    
}

public function extract_shortcode($text,$field='')
{
    $result = "";
    if (!empty($text)) {
     if (!empty($field)) {
         if ($field == 'video') {
             $shortcodes = collect([
                new origincode_videogallery,
            ]);
             $compiledDescription = Shortcode::compile($text,$shortcodes);
             $result = $compiledDescription;
             //$result = json_encode($result);
         }elseif ($field == 'description') {

         }
     }
 }
 return $result;
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

        $galleries[] = isset($this->string_to_json($v,'image_id',true)[0])?$this->string_to_json($v,'image_id',true)[0]:$this->string_to_json($v,'image_id',true);
    }
    $result = json_encode($galleries);
}
}else{
    $result = json_encode($result);
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
public function string_to_json($string,$type='',$format=false)
{
 $result = [];
 if (!empty($string)) {
     if ($type == 'image') {
        $convert_string_1 = str_replace('https://touristbook.s3.ap-south-1.amazonaws.com/', '', $string);
        $convert_string_2 = str_replace('https://test.thetouristbook.com/', '', $convert_string_1);
        $convert_string_3 = str_replace('https://test-touristbook.com/', '', $convert_string_2);
        $s3_image = DB::connection($this->wp_connection)->table('wp_as3cf_items as s3_image')
        ->select('source_id')
        ->where('path','like',$convert_string_3)
        ->select('s3_image.*')
        ->first();
        if (!empty($s3_image->source_id)) {
            $file = File::where('wp_id',$s3_image->source_id)->first();
            $media = $file->get_media;
            $test['id'] = $media->id;
            $test['url'] = $file->getFirstMediaUrl('images');
            $result[] = $test;
            if (!$format) {
                $result = json_encode($result);
            }
        }

    }elseif ($type == 'image_id') {

        $file = File::where('wp_id',$string)->first();
        if (!empty($file)) {
            $media = $file->get_media;
            $test['id'] = $media->id;
            $test['url'] = $media->getUrl();
            $result[] = $test;
            if (!$format) {
                $result = json_encode($result);
            }

        }


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

public function geolocationaddress($lat, $long)
{
    $geocode = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$long&sensor=false&key=AIzaSyCF8MnYK1Ft-lPa3_B6rirg2IJzptB4m1Y";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $geocode);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $output = json_decode($response);
    $dataarray = get_object_vars($output);
    if ($dataarray['status'] != 'ZERO_RESULTS' && $dataarray['status'] != 'INVALID_REQUEST') {

        if (isset($dataarray['results'][0]->formatted_address)) {

            $address = $dataarray['results'][0]->formatted_address;

        } else {
            $address = 'Not Found';

        }
    } else {
        $address = 'Not Found';
    }

    return $address;
}
public function get_content_from_wp($id, $post_type)
{
    $geocode = "https://test.thetouristbook.com/wp-json/wtrest/tours?id=$id&post_type=$post_type";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $geocode);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $output = json_decode($response);
    $content = "";
    


    if (!empty($output) && isset($output[0])) {
       $content = str_replace("\n","",$output[0]->content);
       $content = str_replace("\t","",$content);
   } else {
       $content = '';
   }

   return $content;
}

public function load_tour_details() {
    $this->info("Tour Details Loading...");
    $post_collections = DB::connection($this->wp_connection)->table("wp_st_tours")->select("post_id")->get();
    $postIds = $post_collections->pluck('post_id')->toArray();

    $tourIds = Tour::whereIn("wp_id", $postIds)->select("wp_id", "id")->pluck('id', 'wp_id');
    $recourd_count = 0;
    foreach (array_chunk($postIds, 200) as $pIds) {

            // Get Postmeta
        $pQuery = DB::connection($this->wp_connection)->table('wp_posts as p')
        ->select('p.*', 'pm.*')
        ->join('wp_postmeta as pm', 'pm.post_id', '=', 'p.ID')
        ->whereIn('pm.meta_key', [
            'map_type', 'st_google_map', 'map_lat', 'map_lng', 'map_zoom', 'enable_street_views_google_map', 'is_iframe', 'st_booking_option_type', 'gallery', 'video', 'show_agent_contact_info','email','phone','fax','website', 'st_tour_external_booking', 'st_tour_external_booking_link', 'tours_coupan', 'tours_include', 'tours_exclude', 'tours_highlight', 'tour_sponsored_by', 'tours_destinations', 'tour_helpful_facts', 'tours_program_style', 'tours_program', 'tours_program_bgr', 'tours_program_style4', 'tours_faq', 'st_tours_country', 'package_route', 'calendar_check_in', 'calendar_check_out', 'calendar_adult_price', 'calendar_child_price', 'calendar_infant_price', 'calendar_starttime_hour', 'calendar_starttime_minute', 'calendar_starttime_format', 'calendar_status', 'calendar_groupday', 'st_allow_cancel', 'st_cancel_percent', 'st_cancel_number_days', 'ical_url', 'is_meta_payment_gateway_st_submit_form', 'helpful_facts', 'sponsored_by', 'sponsored_description', 'sponsored_title'
        ])
        ->whereIn('p.ID', $pIds)
        ->orderBy('p.ID', 'desc');
        $results = $pQuery->get();
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

                $tourDetails = collect([]);
            // Directly insert into $tourDetails


                foreach($nestedResults as $postId => $n_result){

                    $tourId = $tourIds[$postId];


                    $latitude = $this->get_key_data($n_result['postmeta'], "map_lat");
                    $longitude = $this->get_key_data($n_result['postmeta'], "map_lng");

                    $tourDetail = [
                        "tour_id" => $tourId,
                        'map_address'=>$this->geolocationaddress($latitude,$longitude),
                        "latitude" => $this->get_key_data($n_result['postmeta'], "map_lat"),
                    // Need to add values here
                        "longitude" => $this->get_key_data($n_result['postmeta'], "map_lng"),
                        "zoom_level" => $this->get_key_data($n_result['postmeta'], "map_zoom"),
                        "enable_street_views_google_map" => $this->radio_value_modify($this->get_key_data($n_result['postmeta'], "enable_street_views_google_map")),
                        "is_iframe" => $this->radio_value_modify($this->get_key_data($n_result['postmeta'], "is_iframe")),
                        "st_booking_option_type" => $this->get_key_data($n_result['postmeta'], "st_booking_option_type"),
                        "gallery" =>$this->comma_saprated_to_array($this->get_key_data($n_result['postmeta'], "gallery"),'gallery'),
                        "video" => $this->get_key_data($n_result['postmeta'], "video"),
                    // {"info":null,"email":"erpritam2013@gmail.com","website":"https:\/\/www.tripclap.com\/contact-us","phone":"8295294203","fax":"122354556"}
                        "contact" => json_encode([
                            "info" => $this->get_key_data($n_result['postmeta'], "show_agent_contact_info"),
                            "email" => $this->get_key_data($n_result['postmeta'], "email"),
                            "phone" => $this->get_key_data($n_result['postmeta'], "phone"),
                            "fax" => $this->get_key_data($n_result['postmeta'], "fax")
                        ]),
                        "st_tour_external_booking" => $this->radio_value_modify($this->get_key_data($n_result['postmeta'], "st_tour_external_booking")),
                        "st_tour_external_booking_link" => $this->get_key_data($n_result['postmeta'], "st_tour_external_booking_link"),
                        "tours_coupan" => $this->get_key_data($n_result['postmeta'], "tours_coupan"),
                        "tours_include" => $this->get_key_data($n_result['postmeta'], "tours_include"),
                        "tours_exclude" => $this->get_key_data($n_result['postmeta'], "tours_exclude"),
                        "tours_highlight" => $this->get_key_data($n_result['postmeta'], "tours_highlight"),
                        "tour_sponsored_by" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "tour_sponsored_by"),'tour_sponsored_by'),
                        "tours_destinations" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "tours_destinations"),'tours_destinations'),
                        "tour_helpful_facts" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "tour_helpful_facts"),'tour_helpful_facts'),
                        "tours_program_style" => $this->get_key_data($n_result['postmeta'], "tours_program_style"),
                        "tours_program" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "tours_program"),'tours_program'),
                        "tours_program_bgr" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "tours_program_bgr"),'tours_program_bgr'),
                        "tours_program_style4" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "tours_program_style4"),'tours_program_style4'),
                        "tours_faq" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "tours_faq"),'tours_faq'),
                        "st_tours_country" => $this->get_key_data($n_result['postmeta'], "st_tours_country"),
                        "package_route" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "package_route"),'package_route'),
                        "st_tours_country" => $this->get_key_data($n_result['postmeta'], "st_tours_country"),
                        "calendar_check_in" => $this->get_key_data($n_result['postmeta'], "calendar_check_in"),
                        "calendar_check_out" => $this->get_key_data($n_result['postmeta'], "calendar_check_out"),
                        "calendar_adult_price" => $this->get_key_data($n_result['postmeta'], "calendar_adult_price"),
                        "calendar_child_price" => $this->get_key_data($n_result['postmeta'], "calendar_child_price"),
                        "calendar_infant_price" => $this->get_key_data($n_result['postmeta'], "calendar_infant_price"),
                        "calendar_starttime_hour" => $this->get_key_data($n_result['postmeta'], "calendar_starttime_hour"),
                        "calendar_starttime_minute" => $this->get_key_data($n_result['postmeta'], "calendar_starttime_minute"),
                        "calendar_starttime_format" => $this->get_key_data($n_result['postmeta'], "calendar_starttime_format"),
                        "calendar_status" => $this->get_key_data($n_result['postmeta'], "calendar_status"),
                        "calendar_groupday" => $this->radio_value_modify($this->get_key_data($n_result['postmeta'], "calendar_groupday")),
                        "st_allow_cancel" => $this->radio_value_modify($this->get_key_data($n_result['postmeta'], "st_allow_cancel")),
                        "st_cancel_percent" => $this->get_key_data($n_result['postmeta'], "st_cancel_percent"),
                        "st_cancel_number_days" => $this->get_key_data($n_result['postmeta'], "st_cancel_number_days"),
                        "ical_url" => $this->get_key_data($n_result['postmeta'], "ical_url"),
                        "is_meta_payment_gateway_st_submit_form" => $this->radio_value_modify($this->get_key_data($n_result['postmeta'], "is_meta_payment_gateway_st_submit_form")),
                        "helpful_facts" => $this->get_key_data($n_result['postmeta'], "helpful_facts"),
                        "sponsored" => json_encode([
                            "sponsored_title" => $this->get_key_data($n_result['postmeta'], "sponsored_title"),
                            "sponsored_description" => $this->get_key_data($n_result['postmeta'], "sponsored_description"),
                            "sponsored_by" => $this->get_key_data($n_result['postmeta'], "sponsored_by")
                        ]),
                        "created_at" => $n_result["post_date_gmt"],
                        "updated_at" => $n_result["post_modified_gmt"]
                    ];
                    $recourd_count = $recourd_count+200;
                    $this->info("$recourd_count Record Loaded");
                    $tourDetails->push($tourDetail);

                }

                TourDetail::insert($tourDetails->toArray());

            }

            $this->info("Tour Details Loaded");
        }


    /**
     * Tour Module
     */
    public function tour_migrate() 
    {
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
                    $nestedResults[$postId]['postmeta'][$metaKey] = $this->unserialize_data_format_in_array($metaValue,$metaKey);
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
                        "price" => $n_result["sale_price"],
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
                        "is_sale_schedule" => $this->radio_value_modify($n_result["is_sale_schedule"]),
                        "discount" => $n_result["discount"],
                        "sale_price_from" => $n_result["sale_price_from"],
                        "sale_price_to" => $n_result["sale_price_to"],
                        "is_featured" => $this->radio_value_modify($n_result["is_featured"]),
                        "featured_image" => $this->string_to_json($this->get_key_data($n_result["postmeta"], "_thumbnail_id"),'image_id'),
                        "discount_type" => $this->get_key_data($n_result["postmeta"], "discount_type"),
                        "discount_by_child" => $this->get_key_data($n_result["postmeta"], "discount_by_child"),
                        "discount_by_adult" => $this->get_key_data($n_result["postmeta"], "discount_by_adult"),
                        "discount_by_people_type" => $this->get_key_data($n_result["postmeta"], "discount_by_people_type"),
                        "calculator_discount_by_people_type" => $this->get_key_data($n_result["postmeta"], "calculator_discount_by_people_type"),
                        "hide_adult_in_booking_form" => $this->radio_value_modify($this->get_key_data($n_result["postmeta"], "hide_adult_in_booking_form")),
                        "hide_children_in_booking_form" => $this->radio_value_modify($this->get_key_data($n_result["postmeta"], "hide_children_in_booking_form")),
                        "hide_infant_in_booking_form" => $this->radio_value_modify($this->get_key_data($n_result["postmeta"], "hide_infant_in_booking_form")),
                        "disable_adult_name" => $this->radio_value_modify($this->get_key_data($n_result["postmeta"], "disable_adult_name")),
                        "disable_children_name" => $this->radio_value_modify($this->get_key_data($n_result["postmeta"], "disable_children_name")),
                        "disable_infant_name" => $this->radio_value_modify($this->get_key_data($n_result["postmeta"], "disable_infant_name")),
                        "extra_price" => $this->get_key_data($n_result["postmeta"], "extra_price"),
                        "created_by" => $n_result["post_author"], 
                        "created_at" => $n_result["post_date_gmt"],
                        "updated_at" => $n_result["post_modified_gmt"],
                        "country_zone_id" => $this->get_key_data($n_result["postmeta"], "st_country_zone_id"),
                        "tour_price_by" => $this->get_key_data($n_result["postmeta"], "tour_price_by"),
                        'status'=>1

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
     * File Module
     */
     public function file_migrate() {
        $this->info("File Data Loading...");
        $post_collections = DB::connection($this->wp_connection)->table("wp_as3cf_items")->select("source_id")->get();
        $postIds = $post_collections->pluck('source_id')->toArray();


        $test_count = 0;
        foreach(array_chunk($postIds, 200) as $pIds) {

            $pQuery = DB::connection($this->wp_connection)->table('wp_as3cf_items as wp_as3')
            ->whereIn('wp_as3.source_id', $pIds)
            ->select('wp_as3.source_id','wp_posts.*')
            ->join("wp_posts", "wp_as3.source_id", '=', 'wp_posts.ID')
            ->where('wp_posts.post_type', 'attachment')
            ->orderBy('wp_posts.ID', 'desc');

            $results = $pQuery->get();

            $test_count = $test_count + $results->count();

            $nestedResults = [];
            $serializer_fields = ['_wp_attachment_metadata'];

            foreach ($results as $result) {
                $postId = $result->ID;
                unset($result->ID); // Remove the ID field from the main post data

                if (!isset($nestedResults[$postId])) {
                    $nestedResults[$postId] = (array) $result;
                   // $nestedResults[$postId]['postmeta'] = [];
                }

                //$metaKey = $result->meta_key;
                //$metaValue = $result->meta_value;

               // unset($result->meta_key, $result->meta_value); // Remove meta_key and meta_value fields

                // if(in_array($metaKey, $serializer_fields)) {
                //     // Serialized Results
                //     $nestedResults[$postId]['postmeta'][$metaKey] = $this->unserialize_data_format_in_array($metaValue);
                // }else {
                //     $nestedResults[$postId]['postmeta'][$metaKey] = $metaValue;
                // }

            }

            //dump($nestedResults);
            // TODO: Can think better way
            // One more iteration for Laravel Specific
            $file_s = collect([]);
            if(!empty($nestedResults)) {
                foreach($nestedResults as $postId => $n_result) {
                    $file = [
                        "wp_id" => $postId,
                        "created_at" => $n_result["post_date_gmt"],
                        "updated_at" => $n_result["post_modified_gmt"],

                    ];

                    $file_s->push($file);


                }

                File::insert($file_s->toArray());
            }



        }




        // TODO: File Details


        $this->info("File Data Loading Completed");
    }

      /**
     * Media Module
     */
      public function media_migrate() {
        $this->info("Media Data Loading...");
        $post_collections = DB::connection($this->wp_connection)->table("wp_as3cf_items")->select("source_id")->get();
        $postIds = $post_collections->pluck('source_id')->toArray();

        foreach(array_chunk($postIds, 200) as $pIds) {

            $pQuery = DB::connection($this->wp_connection)->table('wp_posts as p')
            ->select('p.*', 'pm.*', 'wp_as3cf_items.*')
            ->leftJoin("wp_as3cf_items", "wp_as3cf_items.source_id", '=', 'p.ID')
            ->join('wp_postmeta as pm', 'pm.post_id', '=', 'p.ID')
            ->whereIn('pm.meta_key', ['as3cf_filesize_total','_wp_attachment_metadata'])
            ->where('p.post_type', 'attachment')
            ->whereIn('p.ID', $pIds)
            ->orderBy('p.ID', 'desc');

            $results = $pQuery->get();

            $nestedResults = [];
            $serializer_fields = ['_wp_attachment_metadata'];

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
                    $nestedResults[$postId]['postmeta'][$metaKey] = $this->unserialize_data_format_in_array($metaValue);
                }else {
                    $nestedResults[$postId]['postmeta'][$metaKey] = $metaValue;
                }

            }
            //dump($nestedResults);

            // TODO: Can think better way
            // One more iteration for Laravel Specific
            $media_s = collect([]);
            if(!empty($nestedResults)) {
                foreach($nestedResults as $postId => $n_result) {
                    $model = File::where('wp_id',$postId)->first();
                    $media = [
                        "model_type" => "App\Models\File",
                        "model_id" =>  $model->id,
                        "uuid" =>   Str::uuid(),
                        "collection_name" => 'images',
                        "name" => $n_result["post_title"],
                        "file_name" => $this->get_image_name($n_result["source_path"],'image'),
                        "mime_type" => $n_result["post_mime_type"],
                        "disk" => 's3',
                        "conversions_disk" => 's3',
                        "size" => $this->get_key_data($n_result["postmeta"], "as3cf_filesize_total"),
                        "generated_conversions" => $this->media_sizes($this->get_key_data($n_result["postmeta"], "_wp_attachment_metadata")),
                        "order_column" => 1,
                        "created_at" => $this->set_image_date($n_result["source_path"]),
                        "updated_at" => $this->set_image_date($n_result["source_path"])
                    ];
                    $media_s->push($media);


                }

                Media::insert($media_s->toArray());
                //  $this->info("Media Data Loading Completed");
                // exit;
            }



        }


        // TODO: Media Details


        $this->info("Media Data Loading Completed");
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

                            "map_address" => $this->geolocationaddress($this->get_key_data($n_result["postmeta"], "map_lat"),$this->get_key_data($n_result["postmeta"], "map_lng")),

                            "is_featured" => $this->get_key_data($n_result["postmeta"], "is_featured"),
                            "parent_id" => $n_result["post_parent"],
                            "menu_order" => $n_result["menu_order"],
                            "logo" => $this->get_key_data($n_result["postmeta"], "logo"),

                            "featured_image" => $this->string_to_json($this->get_key_data($n_result["postmeta"], "_thumbnail_id"),'image_id'),
                            "status" => 1,
                            "created_by" => $n_result["post_author"], 
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

        $post_collections = Location::select("wp_id")->get();
        $postIds = $post_collections->pluck('wp_id')->toArray();
        foreach(array_chunk($postIds, 10) as $pIds) {
            $results = DB::connection($this->wp_connection)->table('wp_posts as p')
            ->select('p.ID as ID', 'pm.*')
            ->join('wp_postmeta as pm', 'pm.post_id', '=', 'p.ID')
            ->where('pm.meta_value','!=','')
            ->whereIn('pm.meta_key', ["helpful_facts","place_to_visit","place_to_visit_description","best_time_to_visit","best_time_to_visit_description","how_to_reach","how_to_reach_description","fair_and_festivals","fair_and_festivals_image","fair_and_festivals_description","culinary_retreat","culinary_retreat_description","shopaholics_anonymous","shopaholics_anonymous_description","weather","location_map","what_to_do","get_to_know","get_to_know_image","save_your_pocket","save_your_pocket_image","save_your_environment","save_your_environment_image","faqs","by_aggregators","b_govt_subsidiaries","by_hotels","gallery","location_video","hotel_activities","location_packages","important_note","sanstive_data","hotel_locations","color","location_for_filter","child_tabs"])
            ->where('p.post_type', 'location')
            ->where('p.post_status', 'publish')
            ->whereIn('p.ID', $pIds)
            ->orderBy('p.ID', 'desc')
            ->get();

            $nestedResults = [];
            $serializer_fields =  ["place_to_visit","best_time_to_visit","how_to_reach","fair_and_festivals","culinary_retreat","shopaholics_anonymous","weather","location_map","what_to_do","get_to_know","save_your_pocket","save_your_environment","faqs","by_aggregators","b_govt_subsidiaries","by_hotels","hotel_activities","location_for_filter","location_tab_item","child_tabs"

        ];
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
                        $nestedResults[$postId]['postmeta'][$metaKey] = $this->unserialize_data_format_in_array($metaValue,$metaKey);
                    }else {
                        $nestedResults[$postId]['postmeta'][$metaKey] = $metaValue;
                    }

                }

                // dump($nestedResults);
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
                            'location_tab_item'=> $this->get_key_data($n_result["postmeta"],'location_tab_item')

                        ];
                        $location_data = Location::where('wp_id',$postId)->first();
                        $location_meta = [
                            "location_id" => $location_data->id,
                            "location_content" => json_encode($location_content),
                            "helpful_facts" => $this->get_key_data($n_result["postmeta"], "helpful_facts"), 
                            "place_to_visit" => $this->get_key_data($n_result["postmeta"], "place_to_visit"), 
                            "place_to_visit_description" => $this->get_key_data($n_result["postmeta"], "place_to_visit_description"), 
                            "best_time_to_visit" => $this->get_key_data($n_result["postmeta"], "best_time_to_visit"), 
                            "best_time_to_visit_description" => $this->get_key_data($n_result["postmeta"], "best_time_to_visit_description"), 
                            "how_to_reach" => $this->get_key_data($n_result["postmeta"], "how_to_reach"), 
                            "how_to_reach_description" => $this->get_key_data($n_result["postmeta"], "how_to_reach_description"), 
                            "fair_and_festivals" => $this->get_key_data($n_result["postmeta"], "fair_and_festivals"), 
                            "fair_and_festivals_image" => $this->string_to_json($this->get_key_data($n_result["postmeta"], "fair_and_festivals_image"),'image'),  
                            "fair_and_festivals_description" => $this->get_key_data($n_result["postmeta"], "fair_and_festivals_description"), 
                            "culinary_retreat" => $this->get_key_data($n_result["postmeta"], "culinary_retreat"), 
                            "culinary_retreat_description" => $this->get_key_data($n_result["postmeta"], "culinary_retreat_description"), 
                            "shopaholics_anonymous" => $this->get_key_data($n_result["postmeta"], "shopaholics_anonymous"), 
                            "shopaholics_anonymous_description" => $this->get_key_data($n_result["postmeta"], "shopaholics_anonymous_description"), 
                            "weather" => $this->get_key_data($n_result["postmeta"], "weather"), 
                            "location_map" => $this->get_key_data($n_result["postmeta"], "location_map"), 
                            "what_to_do" => $this->get_key_data($n_result["postmeta"], "what_to_do"), 
                            "get_to_know" => $this->get_key_data($n_result["postmeta"], "get_to_know"), 
                            "get_to_know_image" =>  $this->string_to_json($this->get_key_data($n_result["postmeta"], "get_to_know_image"),'image'), 
                            "save_your_pocket" => $this->get_key_data($n_result["postmeta"], "save_your_pocket"), 
                            "save_your_pocket_image" => $this->string_to_json($this->get_key_data($n_result["postmeta"], "save_your_pocket_image"),'image'), 
                            "save_your_environment" => $this->get_key_data($n_result["postmeta"], "save_your_environment"), 
                            "save_your_environment_image" => $this->string_to_json($this->get_key_data($n_result["postmeta"], "save_your_environment_image"),'image'), 
                            "faqs" => $this->get_key_data($n_result["postmeta"], "faqs"), 
                            "by_aggregators" => $this->get_key_data($n_result["postmeta"], "by_aggregators"), 
                            "b_govt_subsidiaries" => $this->get_key_data($n_result["postmeta"], "b_govt_subsidiaries"), 
                            "by_hotels" => $this->get_key_data($n_result["postmeta"], "by_hotels"), 
                            "gallery" => $this->comma_saprated_to_array($this->get_key_data($n_result["postmeta"], "location_gallery"),'gallery'), 
                            "location_video" => $this->extract_shortcode($this->get_key_data($n_result["postmeta"], "location_video"),'video'), 
                            "hotel_activities" => $this->get_key_data($n_result["postmeta"], "by_hotels"),  
                            "location_packages" => "[]", 
                            "important_note" => $this->get_key_data($n_result["postmeta"], "important_note"), 
                            "sanstive_data" => $this->get_key_data($n_result["postmeta"], "sanstive_data"), 
                            // "hotel_locations" => $this->get_key_data($n_result["postmeta"], "hotel_locations"), 
                            "color" => $this->get_key_data($n_result["postmeta"], "color"), 
                            "location_for_filter" => $this->get_key_data($n_result["postmeta"], "location_for_filter"), 
                            'packages'=>'tour',
                            'stay'=>'hotel',
                            'child_tabs'=>$this->get_key_data($n_result["postmeta"], "child_tabs")

                        ];

                        $location_metas->push($location_meta);


                    }
                    
                    LocationMeta::insert($location_metas->toArray());

                }

            }

            $this->info("Location Meta Data Loading Completed");
        } 

        /*country zone migration*/

        public function st_country_zones_migration()
        {
            $this->info("Country zones Data Loading...");
            $results = DB::connection($this->wp_connection)->table('wp_posts as p')
            ->select('p.*', 'pm.*')
            ->join('wp_postmeta as pm', 'pm.post_id', '=', 'p.ID')
            ->whereIn('pm.meta_key', ["country_zone_title","country","country_zone_icon","country_zone_image","country_description","country_zone_section","country_zone_catering_title", 
                "custom_country_zone_catering_url" ])
            ->where('p.post_type', 'st_country_zones')
            ->where('p.post_status', 'publish')
            ->orderBy('p.ID', 'desc')

            ->get();


              // Build 500 Objects
            $nestedResults = [];
            $serializer_fields =  ["country_zone_section"];

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
                        $nestedResults[$postId]['postmeta'][$metaKey] = $this->unserialize_data_format_in_array($metaValue,$metaKey);
                    }else {
                        $nestedResults[$postId]['postmeta'][$metaKey] = $metaValue;
                    }
                }

                // TODO: Can think better way
                // One more iteration for Laravel Specific
                $country_zones = collect([]);
                if(!empty($nestedResults)) {
                    foreach($nestedResults as $postId => $n_result) {


                      $coutry_zone_catering = [
                        "title"=> $this->get_key_data($n_result["postmeta"], "country_zone_catering_title"),
                        "url"=> $this->get_key_data($n_result["postmeta"], "custom_country_zone_catering_url")
                    ];
                    $country_zone = [
                        "title" => $n_result["post_title"], 
                        "description" => $n_result["post_content"], 
                        "excerpt" => $n_result["post_excerpt"], 
                        "slug" => $n_result["post_name"],
                        "sub_title" => $this->get_key_data($n_result["postmeta"], "country_zone_title"), 
                        "country" => $this->get_key_data($n_result["postmeta"], "country"),
                        "icon" => $this->string_to_json($this->get_key_data($n_result["postmeta"], "country_zone_icon"),'image'), 
                        "image" => $this->string_to_json($this->get_key_data($n_result["postmeta"], "country_zone_image"),'image'), 
                        "country_zone_description" => $this->get_key_data($n_result["postmeta"], "country_description"), 
                        "country_zone_section" => $this->get_key_data($n_result["postmeta"], "country_zone_section"),
                        "country_zone_catering" => json_encode($coutry_zone_catering),
                        "created_by" => $n_result["post_author"], 
                        "status" => 1,
                        "created_at"=>$n_result["post_date_gmt"],
                        "updated_at"=>$n_result["post_modified"]
                    ];

                    $country_zones->push($country_zone);


                }
                     //dd($locations->toArray());
                CountryZone::insert($country_zones->toArray());
            }

            $this->info("Country Zone Data Loading Completed");
        }

        public function wp_option_get_value($key)
        {
            $result = "";
            $wp_option = DB::connection($this->wp_connection)->table('wp_options')
            ->select('*')
            ->where('wp_options.option_name','=',$key)
            ->first();

            if (!empty($wp_option)) {
                $result = $wp_option->option_value;
            }
            return $result;
        }

        public function wp_term_icon_refind($value)
        {
            $result = "";
            if (!empty($value)) {
               if ( $this->tourist_is_serialized($value)) {
                   $unserialize = unserialize($value);
                   if (is_array($unserialize)) {
                    if (isset($unserialize['st_icon'])) {

                       $result = $unserialize['st_icon'];
                   }
               }
           }
       }
       return $result;
   }
   public function wp_term_country_refind($value)
   {
    $result = "";
    if (!empty($value)) {
       if ( $this->tourist_is_serialized($value)) {
           $unserialize = unserialize($value);
           if (is_array($unserialize)) {
            if (isset($unserialize[0])) {

               $result = $unserialize[0];
           }
       }
   }else{
    $result = $value;
}
}
return $result;
}

public function setup_types() {
 $this->info("Terms Type Data Loading...");
 foreach($this->term_category_dictionary as $type => $term_values) {
    $type_list = collect([]);



    $results = DB::connection($this->wp_connection)->table('wp_terms as wt')
    ->select('wt.*', 'wtt.*','wtm.meta_key','wtm.meta_value')

    ->join('wp_term_taxonomy as wtt', 'wt.term_id', '=', 'wtt.term_id')
    ->leftJoin('wp_termmeta as wtm', 'wt.term_id', '=', 'wtm.term_id') 
    ->where('wtt.taxonomy', $term_values['column'])
    ->orderBy('wt.term_id', 'asc')->get();


    $nestedResults = [];
            // $serializer_fields =  ["country_zone_section"];

    foreach ($results as $result) {
        $termId = $result->term_id;
                    //unset($result->term_id); // Remove the ID field from the main term data

        if (!isset($nestedResults[$termId])) {
            $nestedResults[$termId] = (array) $result;
            $nestedResults[$termId]['termmeta'] = [];
        }

        $metaKey = $result->meta_key;
        $metaValue = $result->meta_value;

                    unset($result->meta_key, $result->meta_value); // Remove meta_key and meta_value fields
                    if (!empty($metaKey)) {

                        $nestedResults[$termId]['termmeta'][$metaKey] = $metaValue;
                    }
                }



                if(!empty($nestedResults)) {
                    foreach($nestedResults as $termId => $n_result) {
                        $tax_met_value = 'tax_meta_'.$n_result['term_taxonomy_id'];
                        $single_type = [
                            "name" => $n_result['name'],
                            "slug" => $n_result['slug'],
                        "parent_id" => 0, // We will set it
                        "description" => $n_result['description'],
                        "type" => $type,
                        "wp_term_id" => $termId,
                        "lebal_type" => $this->get_key_data($n_result["termmeta"], "st_label"),
                        "attachment"=>$this->get_key_data($n_result["termmeta"], "st_tour_type_image"),
                        "icon"=> $this->wp_term_icon_refind($this->wp_option_get_value($tax_met_value)),
                        "wp_taxonomy_id" => $n_result['term_taxonomy_id']
                    ];

                    $type_list->push($single_type);

                }



                Type::insert($type_list->toArray());

            }

        }

        $this->info("Terms Type Data Loading Completed");


    }
    public function setup_package_types() {
     $this->info("Terms Package Type Data Loading...");

     foreach($this->tour_package_type as $type => $term_values) {
        $package_type_list = collect([]);

        $results = DB::connection($this->wp_connection)->table('wp_terms as wt')
        ->select('wt.*', 'wtt.*','wtm.meta_key','wtm.meta_value')

        ->join('wp_term_taxonomy as wtt', 'wt.term_id', '=', 'wtt.term_id')
        ->leftJoin('wp_termmeta as wtm', 'wt.term_id', '=', 'wtm.term_id')
        ->where('wtt.taxonomy', $term_values['column'])
        ->orderBy('wt.term_id', 'asc')->get();


        $nestedResults = [];
            // $serializer_fields =  ["country_zone_section"];

        foreach ($results as $result) {
            $termId = $result->term_id;
                    //unset($result->term_id); // Remove the ID field from the main term data

            if (!isset($nestedResults[$termId])) {
                $nestedResults[$termId] = (array) $result;
                $nestedResults[$termId]['termmeta'] = [];
            }

            $metaKey = $result->meta_key;
            $metaValue = $result->meta_value;

                    unset($result->meta_key, $result->meta_value); // Remove meta_key and meta_value fields
                    if (!empty($metaKey)) {

                        $nestedResults[$termId]['termmeta'][$metaKey] = $metaValue;
                    }
                }
                if(!empty($nestedResults)) {
                    foreach($nestedResults as $termId => $n_result) {
                        $tax_met_value = 'tax_meta_'.$n_result['term_taxonomy_id'];
                        $extra_data = [
                            "important_note"=>$this->get_key_data($n_result["termmeta"], "important_note")
                        ];
                        $single_package_type = [
                            "name" => $n_result['name'],
                            "slug" => $n_result['slug'],
                        "parent_id" => $n_result['parent'], // We will set it
                        "description" => $n_result['description'],
                        "button" => $this->get_key_data($n_result["termmeta"], "set_button"),
                        "package_type_type" => $type,
                        "wp_term_id" => $termId,
                        "icon" => $this->wp_term_icon_refind($this->wp_option_get_value($tax_met_value)),
                        "extra_data"=>json_encode($extra_data),
                        "wp_taxonomy_id" => $n_result['term_taxonomy_id']

                    ];

                    $package_type_list->push($single_package_type);

                }



                PackageType::insert($package_type_list->toArray());

            }

        }

        $this->info("Terms Package Type Data Loading Completed");


    }


    public function setup_language() {
     $this->info("Terms Language Data Loading...");
     $language_list = collect([]);
     $results = DB::connection($this->wp_connection)->table('wp_terms as wt')
     ->select('wt.*', 'wtt.*','wtm.meta_key','wtm.meta_value')

     ->join('wp_term_taxonomy as wtt', 'wt.term_id', '=', 'wtt.term_id')
     ->leftJoin('wp_termmeta as wtm', 'wt.term_id', '=', 'wtm.term_id') 
     ->where('wtt.taxonomy', 'languages')
     ->orderBy('wt.term_id', 'asc')->get();


     $nestedResults = [];
            // $serializer_fields =  ["country_zone_section"];

     foreach ($results as $result) {
        $termId = $result->term_id;
                    //unset($result->term_id); // Remove the ID field from the main term data

        if (!isset($nestedResults[$termId])) {
            $nestedResults[$termId] = (array) $result;
            $nestedResults[$termId]['termmeta'] = [];
        }

        $metaKey = $result->meta_key;
        $metaValue = $result->meta_value;

                    unset($result->meta_key, $result->meta_value); // Remove meta_key and meta_value fields
                    if (!empty($metaKey)) {

                        $nestedResults[$termId]['termmeta'][$metaKey] = $metaValue;
                    }
                }



                if(!empty($nestedResults)) {
                    foreach($nestedResults as $termId => $n_result) {
                        $tax_met_value = 'tax_meta_'.$n_result['term_taxonomy_id'];
                        $single_language = [
                            "name" => $n_result['name'],
                            "slug" => $n_result['slug'],
                        "parent_id" => $n_result['parent'], // We will set it
                        "description" => $n_result['description'],
                        "wp_term_id" => $termId,
                        "icon"=> $this->wp_term_icon_refind($this->wp_option_get_value($tax_met_value)),
                        "wp_taxonomy_id" => $n_result['term_taxonomy_id']
                    ];

                    $language_list->push($single_language);

                }



                Language::insert($language_list->toArray());

            }



            $this->info("Terms Language Data Loading Completed");


        }



        public function associate_language_table($objects, $languages, $language_rel_class ) {

       // dump($languages->pluck('wp_taxonomy_id')->toArray());

        // Fetch association Records
            $related_records = DB::connection($this->wp_connection)->table('wp_term_relationships')
            ->whereIn('object_id', $objects->pluck('wp_id')->toArray())
            ->whereIn('term_taxonomy_id', $languages->pluck('wp_taxonomy_id')->toArray())
            ->get();


            $final_list  = [];
            $objectMapper = $objects->pluck('id', 'wp_id')->toArray();
            $languageMapper = $languages->pluck('id', 'wp_taxonomy_id')->toArray();

            foreach($related_records as $record) {
                if(isset($objectMapper[$record->object_id]) && isset($languageMapper[$record->term_taxonomy_id])) {
                    $this->info("Append");
                    $final_row = [
                    // Need to dynamically tour_id, type_id column
                        'tour_id' => $objectMapper[$record->object_id],
                        'language_id' => $languageMapper[$record->term_taxonomy_id]
                    ];

                    $final_list[] = $final_row;

                }
            }

            if(!empty($final_list)) {
                $language_rel_class::insert($final_list);
            }

        }

        public function associate_package_type_table($objects, $package_types, $package_type_rel_class ) {

       // dump($types->pluck('wp_taxonomy_id')->toArray());

        // Fetch association Records
            $related_records = DB::connection($this->wp_connection)->table('wp_term_relationships')
            ->whereIn('object_id', $objects->pluck('wp_id')->toArray())
            ->whereIn('term_taxonomy_id', $package_types->pluck('wp_taxonomy_id')->toArray())
            ->get();


            $final_list  = [];
            $objectMapper = $objects->pluck('id', 'wp_id')->toArray();
            $package_typeMapper = $package_types->pluck('id', 'wp_taxonomy_id')->toArray();

            foreach($related_records as $record) {
                if(isset($objectMapper[$record->object_id]) && isset($package_typeMapper[$record->term_taxonomy_id])) {
                    $this->info("Append");
                    $final_row = [
                    // Need to dynamically tour_id, type_id column
                        'tour_id' => $objectMapper[$record->object_id],
                        'package_type_id' => $package_typeMapper[$record->term_taxonomy_id]
                    ];

                    $final_list[] = $final_row;

                }
            }

            if(!empty($final_list)) {
                $package_type_rel_class::insert($final_list);
            }

        }
        public function associate_type_table($objects, $types, $type_rel_class ) {

       // dump($types->pluck('wp_taxonomy_id')->toArray());

        // Fetch association Records
            $related_records = DB::connection($this->wp_connection)->table('wp_term_relationships')
            ->whereIn('object_id', $objects->pluck('wp_id')->toArray())
            ->whereIn('term_taxonomy_id', $types->pluck('wp_taxonomy_id')->toArray())
            ->get();


            $final_list  = [];
            $objectMapper = $objects->pluck('id', 'wp_id')->toArray();
            $typeMapper = $types->pluck('id', 'wp_taxonomy_id')->toArray();

            foreach($related_records as $record) {
                if(isset($objectMapper[$record->object_id]) && isset($typeMapper[$record->term_taxonomy_id])) {
                    $this->info("Append");
                    $final_row = [
                    // Need to dynamically tour_id, type_id column
                        'tour_id' => $objectMapper[$record->object_id],
                        'type_id' => $typeMapper[$record->term_taxonomy_id]
                    ];

                    $final_list[] = $final_row;

                }
            }

            if(!empty($final_list)) {
                $type_rel_class::insert($final_list);
            }

        }

        public function setup_other_packages() {
         $this->info("Terms Other Package Data Loading...");

         foreach($this->tour_other_package as $type => $term_values) {
            $other_package_list = collect([]);

            $results = DB::connection($this->wp_connection)->table('wp_terms as wt')
            ->select('wt.*', 'wtt.*','wtm.meta_key','wtm.meta_value')

            ->join('wp_term_taxonomy as wtt', 'wt.term_id', '=', 'wtt.term_id')
            ->leftJoin('wp_termmeta as wtm', 'wt.term_id', '=', 'wtm.term_id')
            ->where('wtt.taxonomy', $term_values['column'])
            ->orderBy('wt.term_id', 'asc')->get();

            $nestedResults = [];
            // $serializer_fields =  ["country_zone_section"];

            foreach ($results as $result) {
                $termId = $result->term_id;
                    //unset($result->term_id); // Remove the ID field from the main term data

                if (!isset($nestedResults[$termId])) {
                    $nestedResults[$termId] = (array) $result;
                    $nestedResults[$termId]['termmeta'] = [];
                }

                $metaKey = $result->meta_key;
                $metaValue = $result->meta_value;

                    unset($result->meta_key, $result->meta_value); // Remove meta_key and meta_value fields
                    if (!empty($metaKey)) {

                        $nestedResults[$termId]['termmeta'][$metaKey] = $metaValue;
                    }
                }
                if(!empty($nestedResults)) {
                    foreach($nestedResults as $termId => $n_result) {
                        $tax_met_value = 'tax_meta_'.$n_result['term_taxonomy_id'];
                        $extra_data = [
                            "important_note"=>$this->get_key_data($n_result["termmeta"], "important_note")
                        ];
                        $single_package_type = [
                            "name" => $n_result['name'],
                            "slug" => $n_result['slug'],
                        "parent_id" => $n_result['parent'], // We will set it
                        "description" => $n_result['description'],
                        "button" => $this->get_key_data($n_result["termmeta"], "set_button"),
                        "other_package_type" => $type,
                        "country" => $this->wp_term_country_refind($this->get_key_data($n_result["termmeta"], "country")),
                        "wp_term_id" => $termId,
                        "icon" => $this->wp_term_icon_refind($this->wp_option_get_value($tax_met_value)),
                        "extra_data"=>json_encode($extra_data),
                        "wp_taxonomy_id" => $n_result['term_taxonomy_id']

                    ];

                    $other_package_list->push($single_package_type);

                }



                OtherPackage::insert($other_package_list->toArray());

            }

        }

        $this->info("Terms Other Package Data Loading Completed");


    }

    public function associate_other_package_table($objects, $other_packages, $other_package_rel_class ) {

       // dump($types->pluck('wp_taxonomy_id')->toArray());

        // Fetch association Records
        $related_records = DB::connection($this->wp_connection)->table('wp_term_relationships')
        ->whereIn('object_id', $objects->pluck('wp_id')->toArray())
        ->whereIn('term_taxonomy_id', $other_packages->pluck('wp_taxonomy_id')->toArray())
        ->get();


        $final_list  = [];
        $objectMapper = $objects->pluck('id', 'wp_id')->toArray();
        $other_packageMapper = $other_packages->pluck('id', 'wp_taxonomy_id')->toArray();

        foreach($related_records as $record) {
            if(isset($objectMapper[$record->object_id]) && isset($other_packageMapper[$record->term_taxonomy_id])) {
                $this->info("Append");
                $final_row = [
                    // Need to dynamically tour_id, type_id column
                    'tour_id' => $objectMapper[$record->object_id],
                    'other_package_id' => $other_packageMapper[$record->term_taxonomy_id]
                ];

                $final_list[] = $final_row;

            }
        }

        if(!empty($final_list)) {
            $other_package_rel_class::insert($final_list);
        }

    }

    public function associate_term_parent_id($other_package_class,$type,$post_type)
    {
      $this->info("Terms Parent Updating......");
      $terms_parent = $other_package_class::where($type,$post_type)
      ->where('parent_id','!=',0)->get();
      $terms = $other_package_class::where($type,$post_type)->get();
      foreach ($terms as $key => $term) {

       foreach ($terms_parent as $parent) {
           if ($term->wp_taxonomy_id == $parent->parent_id) {
               $parent->parent_id = $term->id;
               $parent->update(); 
           }
       }
   }

   $this->info("Terms Parent Updated");

}



public function setup_states() {
 $this->info("Terms State Data Loading...");

 $state_list = collect([]);

 $results = DB::connection($this->wp_connection)->table('wp_terms as wt')
 ->select('wt.*', 'wtt.*','wtm.meta_key','wtm.meta_value')

 ->join('wp_term_taxonomy as wtt', 'wt.term_id', '=', 'wtt.term_id')
 ->leftJoin('wp_termmeta as wtm', 'wt.term_id', '=', 'wtm.term_id')
 ->where('wtt.taxonomy', 'states')
 ->orderBy('wt.term_id', 'asc')->get();

 $nestedResults = [];
            // $serializer_fields =  ["country_zone_section"];

 foreach ($results as $result) {
    $termId = $result->term_id;
                    //unset($result->term_id); // Remove the ID field from the main term data

    if (!isset($nestedResults[$termId])) {
        $nestedResults[$termId] = (array) $result;
        $nestedResults[$termId]['termmeta'] = [];
    }

    $metaKey = $result->meta_key;
    $metaValue = $result->meta_value;

                    unset($result->meta_key, $result->meta_value); // Remove meta_key and meta_value fields
                    if (!empty($metaKey)) {

                        $nestedResults[$termId]['termmeta'][$metaKey] = $metaValue;
                    }
                }
                if(!empty($nestedResults)) {
                    foreach($nestedResults as $termId => $n_result) {
                        $tax_met_value = 'tax_meta_'.$n_result['term_taxonomy_id'];
                        $extra_data = [
                            "important_note"=>$this->get_key_data($n_result["termmeta"], "activity_important_notes"),
                            "helpful_facts"=>$this->get_key_data($n_result["termmeta"], "helpful_facts"),
                            "sanstive_data"=>$this->get_key_data($n_result["termmeta"], "sanstive_data")
                        ];

                        $single_package_type = [
                            "name" => $n_result['name'],
                            "slug" => $n_result['slug'],
                        "parent_id" => $n_result['parent'], // We will set it
                        "description" => $n_result['description'],
                        "country" => $this->wp_term_country_refind($this->get_key_data($n_result["termmeta"], "country")),
                        "wp_term_id" => $termId,
                        "icon" => $this->wp_term_icon_refind($this->wp_option_get_value($tax_met_value)),
                        "extra_data"=>json_encode($extra_data),
                        "wp_taxonomy_id" => $n_result['term_taxonomy_id']

                    ];

                    $state_list->push($single_package_type);

                }



                State::insert($state_list->toArray());

            }



            $this->info("Terms States Data Loading Completed");


        }

        public function associate_states_table($objects, $states, $state_rel_class ) {

       // dump($types->pluck('wp_taxonomy_id')->toArray());

        // Fetch association Records
            $related_records = DB::connection($this->wp_connection)->table('wp_term_relationships')
            ->whereIn('object_id', $objects->pluck('wp_id')->toArray())
            ->whereIn('term_taxonomy_id', $states->pluck('wp_taxonomy_id')->toArray())
            ->get();


            $final_list  = [];
            $objectMapper = $objects->pluck('id', 'wp_id')->toArray();
            $stateMapper = $states->pluck('id', 'wp_taxonomy_id')->toArray();

            foreach($related_records as $record) {
                if(isset($objectMapper[$record->object_id]) && isset($stateMapper[$record->term_taxonomy_id])) {
                    $this->info("Append");
                    $final_row = [
                    // Need to dynamically tour_id, type_id column
                        'tour_id' => $objectMapper[$record->object_id],
                        'state_id' => $stateMapper[$record->term_taxonomy_id]
                    ];

                    $final_list[] = $final_row;

                }
            }

            if(!empty($final_list)) {
                $state_rel_class::insert($final_list);
            }

        }

        public function chnage_content($posts,$post_type)
        {
            if (!empty($posts)) {
                $this->info("Content Changing......");
                $posts->each(function($item)use($post_type){
                  $content = $this->get_content_from_wp($item->wp_id,$post_type);
                  $item->description = $content;
                  $item->update();

              });
                $this->info("Content Changed");
            }else{

                $this->info("Not Found Record");
            }
        }
        public function get_multi_locations($value)
        {
            $result = [];
    // $post = DB::connection($this->wp_connection)->table($table)
    // ->where('post_id', $id)
    // ->first();
            if (!empty($value)) {
                $refind_string = str_replace('_', '', $value);
                $array_location = explode(',', $refind_string);
                $result = $array_location;
            }
            return $result;

        }

        public function associate_tour_location_table($objects, $locations, $location_rel_class ) {

       // dump($types->pluck('wp_taxonomy_id')->toArray());

        // Fetch association Records
            $related_records = DB::connection($this->wp_connection)->table('wp_st_tours')
            ->whereIn('post_id', $objects->pluck('wp_id')->toArray())->get();

            
            $final_list  = [];
            $objectMapper = $objects->pluck('id', 'wp_id')->toArray();
            $locationMapper = $locations->pluck('id', 'wp_id')->toArray();
            
            foreach($related_records as $record) {
                if(isset($objectMapper[$record->post_id])) {
                    $this->info("Append");
                    $get_locations = $this->get_multi_locations($record->multi_location);
                    foreach ($get_locations as $key => $get_location) {
                    $final_row = [
                    // Need to dynamically tour_id, type_id column
                        'tour_id' => $objectMapper[$record->post_id],
                        'location_id' => $locationMapper[$get_location]
                    ];

                    $final_list[] = $final_row;
                    }

                }
            }
            
            if(!empty($final_list)) {
                $location_rel_class::insert($final_list);
            }

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

             //$tables = ['users','tours','locations','location_meta','country_zones'];
            $tables = ['tour_locations'];
          // $term_table = ['languages','tour_languages'];
          // $term_table = ['types','tour_types'];
            // $term_table = ['package_types','tour_package_types'];
            // $term_table = ['other_packages','tour_other_packages'];
            // $term_table = ['states','tour_states'];
            //$tables = ['tour_details'];
            //$tables = ['country_zones'];

          $this->info("Truncating tables...");
          $this->truncate_tables($tables);

          $this->info("Table Truncated...");
      }

         // File Module
       //$this->file_migrate();
         // Media Module
      //  $this->media_migrate();
        // User Module
        //$this->user_migrate();

        // Tour Module
        // $this->tour_migrate();

        //$this->load_tour_details();
        // Location Module

        // $this->location_migrate();

        // Location Meta Module
        // $this->location_meta_migrate();


        // Setup Types

        // $this->setup_types();
        // $this->setup_package_types();
        //$this->setup_other_packages();
     // $this->setup_language();
       // $this->setup_states();
        // Associate with Types
        // For Tour

      $tours = Tour::get();
      // $types = Type::where('type', 'Tour')->get();
      // $languages = Language::get();
      // $this->associate_language_table($tours, $languages, TourLanguage::class);
      $locations = Location::get();
      $this->associate_tour_location_table($tours, $locations, TourLocation::class );
      //$this->associate_type_table($tours, $types, TourType::class);
        // Associate with Types
        // For Tour
       //$tours = Tour::get();
       // $package_types = PackageType::where('package_type_type', 'Tour')->get();
       // $this->associate_package_type_table($tours, $package_types, TourPackageType::class);
       //$other_packages = OtherPackage::where('other_package_type', 'Tour')->get();
       //$states = State::get();

       // $this->associate_other_package_table($tours, $other_packages, TourOtherPackage::class);

        //$this->chnage_content($tours,'st_tours');

      return Command::SUCCESS;

  }
}
