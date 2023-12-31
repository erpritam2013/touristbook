<?php

namespace App\Console\Commands;

use App\Models\Tour;
use App\Models\User;
use App\Models\File;
use App\Models\Page;
use App\Models\Media;
use App\Models\Location;
use App\Models\CountryZone;
use App\Models\Hotel;
use App\Models\Post;
use App\Models\HotelDetail;
use App\Models\LocationMeta;
use App\Models\Activity;
use App\Models\ActivityDetail;
use App\Models\ActivityAttraction;
use App\Models\ActivityTermActivityList;
use App\Models\ActivityLocation;
use App\Models\TourismZone;
use App\Models\ActivityZone;
use App\Models\ActivityPackage;
use App\Models\ActivityPackageActivity;
use App\Models\ActivityActivityZone;
use App\Models\ActivityLists;
use App\Models\ActivityListsActivity;

use App\Models\HotelFacility;
use App\Models\HotelAmenities;
use App\Models\HotelMedicareAssistance;
use App\Models\HotelTopService;
use App\Models\HotelAccessible;
use App\Models\HotelOccupancy;
use App\Models\HotelDeal;
use App\Models\HotelActivity;
use App\Models\HotelPropertyType;
use App\Models\HotelMeetingEvent;

use App\Models\Terms\Attraction;
use App\Models\Terms\TermActivityList;
use App\Models\Terms\Type;
use App\Models\Terms\PackageType;
use App\Models\Terms\OtherPackage;
use App\Models\Terms\State;
use App\Models\Terms\Place;

use App\Models\Terms\Facility;
use App\Models\Terms\Amenity;
use App\Models\Terms\MedicareAssistance;
use App\Models\Terms\TopService;
use App\Models\Terms\Accessible;
use App\Models\Terms\Occupancy;
use App\Models\Terms\DealsDiscount;
use App\Models\Terms\TermActivity;
use App\Models\Terms\PropertyType;
use App\Models\Terms\MeetingAndEvent;

use App\Models\Terms\Language;
use App\Models\TourLanguage;
use App\Models\TourLocation;
use App\Models\ActivityLanguage;
use App\Models\TourDetail;
use App\Models\TourType;
use App\Models\LocationPlace;
use App\Models\HotelState;
use App\Models\HotelPlace;
use App\Models\HotelLocation;

use App\Models\TourPackageType;
use App\Models\TourState;
use App\Models\LocationState;
use App\Models\ActivityState;
use App\Models\RoomState;
use App\Models\Room;
use App\Models\RoomDetail;
use App\Models\RoomType;
use App\Models\RoomFacility;
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

    /**
     * Isset Utility
     */
    function get_key_data($data, $key)
    {
        if (isset($data[$key]) && !empty($data[$key]) && !is_null($data[$key])) {
            return $data[$key];
        }
        return null;
    }


    /**
     * Truncating Tables
     */

    public function truncate_tables(array $tables)
    {
        //$tables = ['users','tours','locations','location_meta','country_zones'];

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
    }

    /**
     * User Module
     */
    public function user_migrate()
    {
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
        if ($usersWithCapabilities->isNotEmpty()) {
            foreach ($usersWithCapabilities as $wp_user) {
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
        if ($users->isNotEmpty()) {
            User::insert($users->toArray());
        }

        $this->info("User Data Loading Completed");
    }


    public function check_content($content, $post_id, $post_type)
    {

        if (!empty($content)) {

            if (str_contains($content, '[vc_row]')) {
                return $this->get_content_from_wp($post_id, $post_type);
            } else {
                return $content;
            }
        } else {
            return null;
        }
    }

    public function tourist_is_serialized($data, $strict = true)
    {
        // If it isn't a string, it isn't serialized.
        if (!is_string($data)) {
            return false;
        }
        $data = trim($data);
        if ('N;' === $data) {
            return true;
        }
        if (strlen($data) < 4) {
            return false;
        }
        if (':' !== $data[1]) {
            return false;
        }
        if ($strict) {
            $lastc = substr($data, -1);
            if (';' !== $lastc && '}' !== $lastc) {
                return false;
            }
        } else {
            $semicolon = strpos($data, ';');
            $brace     = strpos($data, '}');
            // Either ; or } must exist.
            if (false === $semicolon && false === $brace) {
                return false;
            }
            // But neither must be in the first X characters.
            if (false !== $semicolon && $semicolon < 3) {
                return false;
            }
            if (false !== $brace && $brace < 4) {
                return false;
            }
        }
        $token = $data[0];
        switch ($token) {
            case 's':
            if ($strict) {
                if ('"' !== substr($data, -2, 1)) {
                    return false;
                }
            } elseif (!str_contains($data, '"')) {
                return false;
            }
                // Or else fall through.
            case 'a':
            case 'O':
            case 'E':
            return (bool) preg_match("/^{$token}:[0-9]+:/s", $data);
            case 'b':
            case 'i':
            case 'd':
            $end = $strict ? '$' : '';
            return (bool) preg_match("/^{$token}:[0-9.E+-]+;$end/", $data);
        }
        return false;
    }

    public function unserialize_data_format_in_array($value, $field = "")
    {

        $result = "";
        if (!empty($value)) {

            if ($this->tourist_is_serialized($value)) {
                $get_unserialized_value = @unserialize($value);
                if (!empty($field)) {



                    if (is_array($get_unserialized_value)) {
                        $result = [];
                        // $final_result = [];

                        // $collect = collect($get_unserialized_value);
                        $image_keys = ['video_thumbnail', 'image'];
                        foreach ($get_unserialized_value as $key => $value) {
                            foreach ($value as $k => $v) {

                                $result[$key][$field . '-' . $k] = $v;
                                if (in_array($k, $image_keys)) {
                                    $result[$key][$field . '-' . $k] = $this->string_to_json($v, 'image');
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
                } else {

                    $result = json_encode($get_unserialized_value);
                }
            }
        }

        if (!empty($result)) {

            return $result;
        } else {

            $result = "[]";
            return $result;
        }
    }

    public function media_sizes($value)
    {
        $result = "";
        if (!empty($value)) {
            $result = [];
            $json_decode = json_decode($value, true);
            if (!empty($json_decode) && is_array($json_decode)) {
                if (isset($json_decode['sizes'])) {

                    $sizes = $json_decode['sizes'];
                    if (count($sizes) > 0) {
                        foreach ($sizes as $key => $size) {
                            if ($key == 'thumbnail') {
                                $result[$key] = true;
                            } else {
                                if (isset($size['width']) && isset($size['height'])) {
                                    $temp_key = $size['width'] . 'x' . $size['height'];
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
        } else {

            $result = "[]";
            return $result;
        }
    }

    public function set_image_date($value)
    {
        $result = date('Y-m-d h:i:s');
        if (!empty($value)) {
            $data_convert_array = explode('/', $value);
            $year_month = $data_convert_array[0] . '-' . $data_convert_array[1];
            $date = date_create($year_month);
            $date_format = date_format($date, "Y-m-d h:i:s");
            $result = $date_format;
        }
        return $result;
    }


    public function extract_shortcode($text, $field = '')
    {
        $result = "";
        if (!empty($text)) {
            if (!empty($field)) {
                if ($field == 'video') {
                    $shortcodes = collect([
                        new origincode_videogallery,
                    ]);
                    $compiledDescription = Shortcode::compile($text, $shortcodes);
                    $result = $compiledDescription;
                    //$result = json_encode($result);
                } elseif ($field == 'description') {
                }
            }
        }
        if (!empty($result)) {

            return $result;
        } else {
            $result = null;
        }
    }


    public function comma_saprated_to_array($value, $type = '')
    {
        $result = [];
        if (!empty($value)) {
            $result = explode(',', $value);
        }

        if (!empty($type)) {
            if ($type == 'gallery') {
                $galleries = [];
                foreach ($result as $k => $v) {

                    $galleries[] = isset($this->string_to_json($v, 'image_id', true)[0]) ? $this->string_to_json($v, 'image_id', true)[0] : $this->string_to_json($v, 'image_id', true);
                }
                $result = json_encode($galleries);
            }
        } else {
            $result = json_encode($result);
        }
        if (!empty($result)) {

            return $result;
        } else {
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
    public function string_to_json($string, $type = '', $format = false)
    {
        $result = [];
        if (!empty($string)) {
            if ($type == 'image') {
                $convert_string_1 = str_replace('https://touristbook.s3.ap-south-1.amazonaws.com/', '', $string);
                $convert_string_2 = str_replace('https://test.thetouristbook.com/', '', $convert_string_1);
                $convert_string_3 = str_replace('https://test-touristbook.com/', '', $convert_string_2);
                $s3_image = DB::connection($this->wp_connection)->table('wp_as3cf_items as s3_image')
                ->select('source_id')
                ->where('path', 'like', $convert_string_3)
                ->select('s3_image.*')
                ->first();
                if (!empty($s3_image->source_id)) {
                    $file = File::where('wp_id', $s3_image->source_id)->first();
                    $media = $file->get_media;
                    $test['id'] = $media->id;
                    $test['url'] = $file->getFirstMediaUrl('images');
                    $result[] = $test;
                    if (!$format) {
                        $result = json_encode($result);
                    }
                }
            } elseif ($type == 'image_id') {

                $file = File::where('wp_id', $string)->first();
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
        } else {
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
          if(is_object($output)){
            
        $dataarray = get_object_vars($output);
        if ($dataarray['status'] != 'ZERO_RESULTS' && $dataarray['status'] != 'INVALID_REQUEST') {

            if (isset($dataarray['results'][0]->formatted_address)) {

                $address = $dataarray['results'][0]->formatted_address;
            } else {
                $address = 'Not Found';
            }

            return $address;
        }
        }
    }
    public function get_content_from_wp($id, $post_type)
    {
        $geocode = "https://test.thetouristbook.com/wp-json/wtrest/posts?id=$id&post_type=$post_type";

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
            $content = str_replace("\n", "", $output[0]->content);
            $content = str_replace("\t", "", $content);
        } else {
            $content = '';
        }

        return $content;
    }

    public function load_tour_details()
    {
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
                'map_type', 'st_google_map', 'map_lat', 'map_lng', 'map_zoom', 'enable_street_views_google_map', 'is_iframe', 'st_booking_option_type', 'gallery', 'video', 'show_agent_contact_info', 'email', 'phone', 'fax', 'website', 'st_tour_external_booking', 'st_tour_external_booking_link', 'tours_coupan', 'tours_include', 'tours_exclude', 'tours_highlight', 'tour_sponsored_by', 'tours_destinations', 'tour_helpful_facts', 'tours_program_style', 'tours_program', 'tours_program_bgr', 'tours_program_style4', 'tours_faq', 'st_tours_country', 'package_route', 'calendar_check_in', 'calendar_check_out', 'calendar_adult_price', 'calendar_child_price', 'calendar_infant_price', 'calendar_starttime_hour', 'calendar_starttime_minute', 'calendar_starttime_format', 'calendar_status', 'calendar_groupday', 'st_allow_cancel', 'st_cancel_percent', 'st_cancel_number_days', 'ical_url', 'is_meta_payment_gateway_st_submit_form', 'helpful_facts', 'sponsored_by', 'sponsored_description', 'sponsored_title'
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


            foreach ($nestedResults as $postId => $n_result) {

                $tourId = $tourIds[$postId];


                $latitude = $this->get_key_data($n_result['postmeta'], "map_lat");
                $longitude = $this->get_key_data($n_result['postmeta'], "map_lng");


                $tourDetail = [
                    "tour_id" => $tourId,
                    'map_address' => $this->geolocationaddress($latitude, $longitude),
                    "latitude" => $this->get_key_data($n_result['postmeta'], "map_lat"),
                    // Need to add values here
                    "longitude" => $this->get_key_data($n_result['postmeta'], "map_lng"),
                    "zoom_level" => $this->get_key_data($n_result['postmeta'], "map_zoom"),
                    "enable_street_views_google_map" => $this->radio_value_modify($this->get_key_data($n_result['postmeta'], "enable_street_views_google_map")),
                    "is_iframe" => $this->radio_value_modify($this->get_key_data($n_result['postmeta'], "is_iframe")),
                    "st_booking_option_type" => $this->get_key_data($n_result['postmeta'], "st_booking_option_type"),
                    "gallery" => $this->comma_saprated_to_array($this->get_key_data($n_result['postmeta'], "gallery"), 'gallery'),
                    "video" => $this->get_key_data($n_result['postmeta'], "video"),

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
                    "tour_sponsored_by" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "tour_sponsored_by"), 'tour_sponsored_by'),
                    "tours_destinations" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "tours_destinations"), 'tours_destinations'),
                    "tour_helpful_facts" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "tour_helpful_facts"), 'tour_helpful_facts'),
                    "tours_program_style" => $this->get_key_data($n_result['postmeta'], "tours_program_style"),
                    "tours_program" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "tours_program"), 'tours_program'),
                    "tours_program_bgr" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "tours_program_bgr"), 'tours_program_bgr'),
                    "tours_program_style4" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "tours_program_style4"), 'tours_program_style4'),
                    "tours_faq" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "tours_faq"), 'tours_faq'),
                    "st_tours_country" => $this->get_key_data($n_result['postmeta'], "st_tours_country"),
                    "package_route" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "package_route"), 'package_route'),
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

                $tourDetails->push($tourDetail);
            }

            $recourd_count = $recourd_count+200;
            $this->info("$recourd_count Record Loaded");
            TourDetail::insert($tourDetails->toArray());
        }

        $this->info("Tour Details Loaded");
    }


    /**
     * Hotel Module Migration
     */
    public function hotel_migrate()
    {

        $this->info("Hotel Data Loading...");
        $post_collections = DB::connection($this->wp_connection)->table("wp_st_hotel")->select("post_id")->get();
        $postIds = $post_collections->pluck('post_id')->toArray();

        foreach (array_chunk($postIds, 200) as $pIds) {

            $pQuery = DB::connection($this->wp_connection)->table('wp_posts as p')
            ->select('p.*', 'pm.*', 'wp_st_hotel.*')
            ->leftJoin("wp_st_hotel", "wp_st_hotel.post_id", '=', 'p.ID')
            ->join('wp_postmeta as pm', 'pm.post_id', '=', 'p.ID')
            ->whereIn('pm.meta_key', [
                'address', 'hotel_link', 'food_and_dining', 'is_featured', 'logo', '_thumbnail_id', 'email', 'phone', 'fax', 'website', 'show_agent_contact_info', 'allow_full_day', 'check_in_time', 'check_out_time', 'hotel_policy', 'important_notices_data', 'gallery', 'video', 'hotel_booking_period', 'min_book_room', 'st_hotel_corporate_address', 'price_avg', 'is_allowed_full_day'
            ])
            ->where('p.post_type', 'st_hotel')
            ->where('p.post_status', 'publish')
            ->whereIn('p.ID', $pIds)
            ->orderBy('p.ID', 'desc');

            $results = $pQuery->get();
            $nestedResults = [];
            // $serializer_fields = ['hotel_policy', 'important_notices_data'];
            $serializer_fields_no_prefix = [];
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

                // if(in_array($metaKey, $serializer_fields_no_prefix)){
                //     $nestedResults[$postId]['postmeta'][$metaKey] = $this->unserialize_data_format_in_array($metaValue);
                // }

                // if (in_array($metaKey, $serializer_fields)) {
                //     // Serialized Results
                //     $nestedResults[$postId]['postmeta'][$metaKey] = $this->unserialize_data_format_in_array($metaValue, $metaKey);
                // } else {
                // }
                $nestedResults[$postId]['postmeta'][$metaKey] = $metaValue;
            }


            // TODO: Can think better way
            // One more iteration for Laravel Specific
            $hotels = collect([]);
            if (!empty($nestedResults)) {
                foreach ($nestedResults as $postId => $n_result) {
                    $hotel = [
                        "wp_id" => $postId,
                        "name" => $n_result["post_title"],
                        "slug" =>  $n_result["post_name"],
                        "description" => $this->check_content($n_result["post_content"], $postId, 'st_hotel'),
                        "address" => $this->get_key_data($n_result["postmeta"], "address"),
                        "external_link" => $this->get_key_data($n_result["postmeta"], "hotel_link"),
                        "food_dining" => $this->get_key_data($n_result["postmeta"], "food_and_dining"),

                        "is_featured" => $this->radio_value_modify($this->get_key_data($n_result["postmeta"], "is_featured")),

                        "logo" => $this->string_to_json($this->get_key_data($n_result["postmeta"], "logo"), 'image'),
                        "featured_image" => $this->string_to_json($this->get_key_data($n_result["postmeta"], "_thumbnail_id"), 'image_id'),
                        "hotel_video" => $this->get_key_data($n_result["postmeta"], "video"),
                        "rating" => $n_result["rate_review"],
                        "coupon_code" => $this->get_key_data($n_result["postmeta"], "address"),

                        "hotel_attributes" => json_encode([

                            "corporateAddress" => $this->get_key_data($n_result["postmeta"], "st_hotel_corporate_address")
                        ]),
                        "contact" => json_encode([
                            "email" => $this->get_key_data($n_result["postmeta"], "email"),
                            "phone" => $this->get_key_data($n_result["postmeta"], "phone"),
                            "fax" => $this->get_key_data($n_result["postmeta"], "fax"),
                            "website" => $this->get_key_data($n_result["postmeta"], "website"),
                            "show_agent_contact_info" => $this->get_key_data($n_result["postmeta"], "show_agent_contact_info")
                        ]),
                        "avg_price" => $this->get_key_data($n_result["postmeta"], "price_avg"),
                        "is_allowed_full_day" =>  $this->radio_value_modify($this->get_key_data($n_result['postmeta'], "allow_full_day")),
                        "check_in" => $this->get_key_data($n_result["postmeta"], "check_in_time"),
                        "check_out" => $this->get_key_data($n_result["postmeta"], "check_out_time"),
                        "book_before_day" => $this->get_key_data($n_result["postmeta"], "hotel_booking_period"),
                        "book_before_arrival" => $this->get_key_data($n_result["postmeta"], "min_book_room"),
                        "policies" => $this->unserialize_data_format_in_array($this->get_key_data($n_result["postmeta"], "hotel_policy"), 'policies'),
                        "notices" => $this->unserialize_data_format_in_array($this->get_key_data($n_result["postmeta"], "important_notices_data"), 'notices'),
                        "check_editing"  => null,
                        "created_by" => $n_result["post_author"],
                        "created_at" => $n_result["post_date_gmt"],
                        "updated_at" => $n_result["post_modified_gmt"],
                        "images" => $this->comma_saprated_to_array($this->get_key_data($n_result['postmeta'], "gallery"), 'gallery'),

                    ];

                    $hotels->push($hotel);
                }

                Hotel::insert($hotels->toArray());
                $this->info("Hotel Data 200 done");
            }
        }
        // TODO: Hotel Details
        $this->info("Hotel Data Loading Completed");
    }

    /**
     * Hotel Detail Moudle
     */

    public function load_hotel_details()
    {
        $this->info("Hotel Details Loading...");
        $postIds = DB::connection($this->wp_connection)->table("wp_st_hotel")->select("post_id")->get()->pluck('post_id')->toArray();
        $hotelIdsC = collect([]);
        foreach (array_chunk($postIds, 100) as $subpostids) {
            $subIds = Hotel::whereIn("wp_id", $subpostids)->select("wp_id", "id")->pluck('id', 'wp_id');
            $hotelIdsC = $hotelIdsC->union($subIds);
        }
        $hotelIds = $hotelIdsC->toArray();

        $recourd_count = 0;
        foreach (array_chunk($postIds, 20) as $pIds) {

            // Get Postmeta
            $this->info("Trying to Loading 20 records...");

            $pQuery = DB::connection($this->wp_connection)->table('wp_posts as p')
            ->select('p.*', 'pm.*')
            ->join('wp_postmeta as pm', 'pm.post_id', '=', 'p.ID')
            ->whereIn('pm.meta_key', ["map_lat", "map_lng", "map_zoom", "hotel_highlight", "hotel_report", "hotel_facilities_amenities", "hotel_food", "food_and_dining", "hotel_complimentary", "hotel_helpful_facts", "hotel_save_your_pocket", "save_your_pocket_pdf", "hotel_save_the_environment", "hotel_land_mark", "hotel_things_to_do", "hotel_offer_package", "hotel_things_to_do_video_link", "hotel_meetings_events", "hotel_tourism_zone", "hotel_tourism_zone_heading_desc", "tourism_zone_pdf", "hotel_activities", "hotel_rooms_amenities", "hotel_transport", "hotel_payment_mode", "hotel_id_proofs", "hotel_emergency_links", "facebook_custom_link", "twitter_custom_link", "instagram_custom_link", "you_tube_custom_link"])
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

            $hotelDetails = collect([]);
            // Directly insert into $hotelDetails


            foreach ($nestedResults as $postId => $n_result) {

                $hotelId = $hotelIds[$postId];


                $latitude = $this->get_key_data($n_result['postmeta'], "map_lat");
                $longitude = $this->get_key_data($n_result['postmeta'], "map_lng");

                $hotelDetail =  [
                    "hotel_id" => $hotelId,
                    'map_address' => $this->geolocationaddress($latitude, $longitude),
                    "latitude" => $this->get_key_data($n_result['postmeta'], "map_lat"),
                    "longitude" => $this->get_key_data($n_result['postmeta'], "map_lng"),
                    "zoom_level" => $this->get_key_data($n_result['postmeta'], "map_zoom"),
                    "highlights" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "hotel_highlight"), 'highlights'),
                    "hotel_report" => $this->get_key_data($n_result['postmeta'], "hotel_report"),
                    "facilityAmenities" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "hotel_facilities_amenities"), 'facilityAmenities'),
                    "foods" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "hotel_food"), 'foods'),
                    "drinks" => $this->get_key_data($n_result['postmeta'], "food_and_dining"),
                    "complimentary" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "hotel_complimentary"), 'complimentary'),
                    "helpfulfacts" => $this->get_key_data($n_result['postmeta'], "hotel_helpful_facts"),
                    "save_pocket" => $this->get_key_data($n_result['postmeta'], "hotel_save_your_pocket"),
                    "pocketPDF" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "save_your_pocket_pdf"), 'pocketPDF'),
                    "save_environment" => $this->get_key_data($n_result['postmeta'], "hotel_save_the_environment"),
                    "landmark" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "hotel_land_mark"), 'landmark'),
                    "todo" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "hotel_things_to_do"), 'todo'),
                    "offers" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "hotel_offer_package"), 'offers'),
                    "todovideo" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "hotel_things_to_do_video_link"), 'todovideo'),
                    "eventmeeting" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "hotel_meetings_events"), 'eventmeeting'),
                    "tourism_zone" => $this->get_key_data($n_result['postmeta'], "hotel_tourism_zone"),
                    "tourism_zone_heading" => $this->get_key_data($n_result['postmeta'], "hotel_tourism_zone_heading_desc"),
                    "tourismzonepdf" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "tourism_zone_pdf"), 'tourismzonepdf'),
                    "activities" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "hotel_activities"), 'activities'),
                    "room_amenities" => $this->get_key_data($n_result['postmeta'], "hotel_rooms_amenities"),
                    "transport" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "hotel_transport"), 'transport'),
                    "payment_mode" => $this->get_key_data($n_result['postmeta'], "hotel_payment_mode"),
                    "id_proofs" => $this->get_key_data($n_result['postmeta'], "hotel_id_proofs"),
                    "emergencyLinks" => $this->unserialize_data_format_in_array($this->get_key_data($n_result['postmeta'], "hotel_emergency_links"), 'emergencyLinks'),
                    "social_links" => json_encode([
                        "facebook_custom_link" => $this->get_key_data($n_result['postmeta'], 'facebook_custom_link'),
                        "twitter_custom_link" => $this->get_key_data($n_result['postmeta'], 'twitter_custom_link'),
                        "instagram_custom_link" => $this->get_key_data($n_result['postmeta'], 'instagram_custom_link'),
                        "you_tube_custom_link" => $this->get_key_data($n_result['postmeta'], 'you_tube_custom_link')
                    ]),
                    "created_at" => $n_result['post_date_gmt'],
                    "updated_at" => $n_result['post_modified_gmt'],
                ];
                $hotelDetails->push($hotelDetail);
            }
            $this->info("20 Record Loaded");

            HotelDetail::insert($hotelDetails->toArray());
        }

        $this->info("Hotel Details Loaded");
    }

     /**
     * Activity Module
     */
     public function activity_migrate()
     {
        $this->info("Activity Data Loading...");
        $post_collections = DB::connection($this->wp_connection)->table("wp_st_activity")->select("post_id")->get();
        $postIds = $post_collections->pluck('post_id')->toArray();

        foreach (array_chunk($postIds, 200) as $pIds) {

            $pQuery = DB::connection($this->wp_connection)->table('wp_posts as p')
            ->select('p.*', 'pm.*', 'wp_st_activity.*')
            ->leftJoin("wp_st_activity", "wp_st_activity.post_id", '=', 'p.ID')
            ->join('wp_postmeta as pm', 'pm.post_id', '=', 'p.ID')
            ->whereIn('pm.meta_key', ["disable_children_name","hide_children_in_booking_form","discount_by_child","hide_adult_in_booking_form","discount_by_adult","discount_by_people_type","calculator_discount_by_people_type","disable_infant_name","hide_infant_in_booking_form","min_price","extra_price","st_activity_external_booking","st_activity_external_booking_link","deposit_payment_status","deposit_payment_amount","activity_booking_period","max_people","st_booking_option_type","logo","_thumbnail_id"
        ])
            ->where('p.post_type', 'st_activity')
            ->where('p.post_status', 'publish')
            ->whereIn('p.ID', $pIds)
            ->orderBy('p.ID', 'desc');

            $results = $pQuery->get();

            $nestedResults = [];
            $serializer_fields = ['discount_by_child','discount_by_adult','extra_price'];
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

                if (in_array($metaKey, $serializer_fields)) {
                    // Serialized Results
                    $nestedResults[$postId]['postmeta'][$metaKey] = $this->unserialize_data_format_in_array($metaValue, $metaKey);
                } else {
                    $nestedResults[$postId]['postmeta'][$metaKey] = $metaValue;
                }
            }


            // TODO: Can think better way
            // One more iteration for Laravel Specific
            $activities = collect([]);
            if (!empty($nestedResults)) {
                foreach ($nestedResults as $postId => $n_result) {
                    $single_activity = [
                        "wp_id" => $postId, 
                        "name" => $n_result["post_title"],
                        "slug" => $n_result["post_name"],
                        "description" => $this->check_content($n_result["post_content"],$postId,'st_activity'),
                        "excerpt" => $n_result["post_excerpt"],
                        "external_link" => null,
                        "address" => $n_result["address"],
                        "price" => $n_result["price"],
                        "sale_price" => $n_result["sale_price"],
                        "child_price" =>  $n_result["child_price"],
                        "disable_children_name" => $this->radio_value_modify($this->get_key_data($n_result["postmeta"], "disable_children_name")),
                        "hide_children_in_booking_form" => $this->radio_value_modify($this->get_key_data($n_result["postmeta"], "hide_children_in_booking_form")),
                        "discount_by_child" => $this->get_key_data($n_result["postmeta"], "discount_by_child"),
                        "adult_price" => $n_result["adult_price"],
                        "hide_adult_in_booking_form" => $this->radio_value_modify($this->get_key_data($n_result["postmeta"], "hide_adult_in_booking_form")),
                        "discount_by_adult" => $this->get_key_data($n_result["postmeta"], "discount_by_adult"),
                        "discount_by_people_type" => $this->get_key_data($n_result["postmeta"], "discount_by_people_type"),
                        "calculator_discount_by_people_type" => $this->get_key_data($n_result["postmeta"], "calculator_discount_by_people_type"),
                        "infant_price" => $n_result["infant_price"],
                        "disable_infant_name" => $this->radio_value_modify($this->get_key_data($n_result["postmeta"], "disable_infant_name")),
                        "hide_infant_in_booking_form" => $this->radio_value_modify($this->get_key_data($n_result["postmeta"], "hide_infant_in_booking_form")),
                        "min_price" => $n_result["min_price"],
                        "extra_price" => $this->get_key_data($n_result["postmeta"], "extra_price"),
                        "st_activity_external_booking" => $this->radio_value_modify($this->get_key_data($n_result["postmeta"], "st_activity_external_booking")),
                        "st_activity_external_booking_link" => $this->get_key_data($n_result["postmeta"], "st_activity_external_booking_link"),
                        "deposit_payment_status" => $this->get_key_data($n_result["postmeta"], "deposit_payment_status"),
                        "deposit_payment_amount" => $this->get_key_data($n_result["postmeta"], "deposit_payment_amount"),
                        "type_activity" => $n_result["type_activity"],
                        "rating" => $n_result["rate_review"],
                        "activity_booking_period" => $this->get_key_data($n_result["postmeta"], "activity_booking_period"),
                        "min_people" => $this->get_key_data($n_result["postmeta"], "min_people"),
                        "max_people" => $n_result["max_people"],
                        "duration" => $n_result["duration"],
                        "is_sale_schedule" => $this->radio_value_modify($n_result["is_sale_schedule"]),
                        "discount" => $n_result["discount"],
                        "sale_price_from" => $n_result["sale_price_from"],
                        "sale_price_to" => $n_result["sale_price_to"],
                        "discount_type" => $this->get_key_data($n_result["postmeta"], "discount_type"),
                        "is_featured" => $this->radio_value_modify($n_result["is_featured"]),
                        "st_booking_option_type" => $this->get_key_data($n_result["postmeta"], "st_booking_option_type"),
                        "logo" => $this->string_to_json($this->get_key_data($n_result["postmeta"], "logo"), 'image'),
                        "featured_image" => $this->string_to_json($this->get_key_data($n_result["postmeta"], "_thumbnail_id"), 'image_id'),
                        "status" => 1,
                        "created_by" => $n_result["post_author"], 
                        "created_at" => $n_result["post_date_gmt"],
                        "updated_at" => $n_result["post_modified_gmt"],
                    ];

                    $activities->push($single_activity);
                }

                Activity::insert($activities->toArray());
            }
        }
        // TODO: Activity Details
        $this->info("Activity Data Loading Completed");
    }

     /**
     * post Module
     */
     public function post_migrate()
     {
        $this->info("post Data Loading...");
        $post_collections = DB::connection($this->wp_connection)->table("wp_posts")->select("ID")->get();
        $postIds = $post_collections->pluck('ID')->toArray();

        $pQuery = DB::connection($this->wp_connection)->table('wp_posts as p')
        ->select('p.*', 'pm.*')
        ->join('wp_postmeta as pm', 'pm.post_id', '=', 'p.ID')
        ->where('p.post_type', 'post')
        ->where('p.post_status', 'publish')
        ->whereIn('p.ID', $postIds)
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


            // TODO: Can think better way
            // One more iteration for Laravel Specific
            $posts = collect([]);
            if (!empty($nestedResults)) {
                foreach ($nestedResults as $postId => $n_result) {
                    $post = [
                        // "wp_id" => $postId,
                        "name" => $n_result["post_title"],
                        "slug" => $n_result["post_name"],
                        "description" => $this->check_content($n_result["post_content"],$postId,'post'),
                        "excerpt" => $n_result["post_excerpt"],
                        "featured_image" => $this->string_to_json($this->get_key_data($n_result["postmeta"],'_thumbnail_id'),'image_id'),
                        "excerpt" => $n_result["post_excerpt"],
                        "created_by" => $n_result["post_author"],
                        "created_at" => $n_result["post_date_gmt"],
                        "updated_at" => $n_result["post_modified_gmt"],
                        'status' => 1

                    ];

                    $posts->push($post);
                }

                Post::insert($posts->toArray());
            }

        // TODO: post Details
            $this->info("post Data Loading Completed");
        }
        public function get_room_hotel($hotel_id)
        {
            $result = 0;
            if (!empty($hotel_id)) {

                $hotel = Hotel::where('wp_id',$hotel_id)->first();
                if (!empty($hotel)) {
                    $result = $hotel->id;
                }
            }
            return $result;
        }
     /**
     * Room Module
     */
     public function room_migrate()
     {
        $this->info("room Data Loading...");
        $post_collections = DB::connection($this->wp_connection)->table("wp_hotel_room")->select("post_id")->get();
        $postIds = $post_collections->pluck('post_id')->toArray();

        foreach (array_chunk($postIds, 200) as $pIds) {

            $pQuery = DB::connection($this->wp_connection)->table('wp_posts as p')
            ->select('p.*', 'pm.*', 'wp_hotel_room.*')
            ->join("wp_hotel_room", "wp_hotel_room.post_id", '=', 'p.ID')
            ->join('wp_postmeta as pm', 'pm.post_id', '=', 'p.ID')
            ->whereIn('pm.meta_key', ["extra_price","extra_price_unit","_thumbnail_id"])
            ->where('p.post_type', 'hotel_room')
            ->where('p.post_status', 'publish')
            ->whereIn('p.ID', $pIds)
            ->orderBy('p.ID', 'desc');

            $results = $pQuery->get();

            $nestedResults = [];
            $serializer_fields = ['extra_price'];
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

                if (in_array($metaKey, $serializer_fields)) {
                    // Serialized Results
                    $nestedResults[$postId]['postmeta'][$metaKey] = $this->unserialize_data_format_in_array($metaValue, $metaKey);
                } else {
                    $nestedResults[$postId]['postmeta'][$metaKey] = $metaValue;
                }
            }


            // TODO: Can think better way
            // One more iteration for Laravel Specific
            $rooms = collect([]);
            if (!empty($nestedResults)) {
                foreach ($nestedResults as $postId => $n_result) {
                    $single_room = [
                        "wp_id" => $postId, 
                        "hotel_id" => $this->get_room_hotel($n_result["room_parent"]),
                        "name" => $n_result["post_title"],
                        "slug" => $n_result["post_name"],
                        "description" => $n_result["post_content"],
                        "excerpt" => $n_result["post_excerpt"],
                        "address" => $n_result["address"],
                        "price" => $n_result["price"],
                        "number_room" => $n_result["number_room"],
                        "adult_number" => $n_result["adult_number"],
                        "children_number" => $n_result["child_number"],
                        "adult_price" => $n_result["adult_price"],
                        "child_price" => $n_result["child_price"],
                        "extra_price" => $this->get_key_data($n_result["postmeta"], "extra_price"),
                        "extra_price_unit" => $this->get_key_data($n_result["postmeta"], "extra_price_unit"),
                        "featured_image" =>  $this->string_to_json($this->get_key_data($n_result["postmeta"], "_thumbnail_id"), 'image_id'),
                        "featured_image_id" => null,
                        "status" => 1,
                        "created_by" => $n_result["post_author"], 
                        "created_at" => $n_result["post_date_gmt"],
                        "updated_at" => $n_result["post_modified_gmt"],
                    ];

                    $rooms->push($single_room);
                }

                Room::insert($rooms->toArray());

                $this->info("200 record done");

            }
        }
        // TODO: room Details
        $this->info("room Data Loading Completed");
    }



    public function load_room_details() {
        $this->info("room Details Loading...");
        $post_collections = DB::connection($this->wp_connection)->table("wp_hotel_room")->select("post_id")->get();
        $postIds = $post_collections->pluck('post_id')->toArray();

        $roomIds = Room::whereIn("wp_id", $postIds)->select("wp_id", "id")->pluck('id', 'wp_id');
        $recourd_count = 0;
        foreach (array_chunk($postIds, 200) as $pIds) {

            // Get Postmeta

            $pQuery = DB::connection($this->wp_connection)->table('wp_posts as p')
            ->select('p.*', 'pm.*')
            ->join('wp_postmeta as pm', 'pm.post_id', '=', 'p.ID')
            ->whereIn('pm.meta_key', ["hotel_alone_room_layout","hotel_alone_room_sub_heading","price_by_per_person","st_booking_option_type","allow_full_day","discount_rate","discount_by_day","discount_type_no_day","discount_type","deposit_payment_status","deposit_payment_amount","gallery","video","room_facility_preview","disable_adult_name","disable_children_name","bed_number","bath_number","room_footage","st_room_external_booking","st_room_external_booking_link","add_new_facility","room_description","defaulte_status","calendar_check_in","calendar_check_out","calendar_price","calendar_status","st_allow_cancel","st_cancel_number_days","st_cancel_percent","ical_url","is_meta_payment_gateway_st_submit_form","facebook_custom_link","twitter_custom_link","instagram_custom_link","you_tube_custom_link"])
            ->whereIn('p.ID', $pIds)
            ->orderBy('p.ID', 'desc');
            $results = $pQuery->get();
            $nestedResults = [];
            $serializer_fields = ["room_program","room_program_bgr","room_faq","room_zones","properties_near_by"];
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



                if (in_array($metaKey, $serializer_fields)) {
                    // Serialized Results
                    $nestedResults[$postId]['postmeta'][$metaKey] = $this->unserialize_data_format_in_array($metaValue, $metaKey);
                } else {
                    $nestedResults[$postId]['postmeta'][$metaKey] = $metaValue;
                }
            }

            $roomDetails = collect([]);
            // Directly insert into $roomDetails


            foreach($nestedResults as $postId => $n_result){

                $roomId = $roomIds[$postId];


                $latitude = $this->get_key_data($n_result['postmeta'], "map_lat");
                $longitude = $this->get_key_data($n_result['postmeta'], "map_lng");


                $roomDetail = [
                    "room_id"  =>  $roomId,
                    "hotel_alone_room_layout" =>$this->radio_value_modify($this->get_key_data($n_result['postmeta'], "hotel_alone_room_layout")) ,
                    "hotel_alone_room_sub_heading" =>$this->get_key_data($n_result['postmeta'], "hotel_alone_room_sub_heading") ,
                    "price_by_per_person" =>$this->radio_value_modify($this->get_key_data($n_result['postmeta'], "price_by_per_person")) ,
                    "st_booking_option_type" =>$this->get_key_data($n_result['postmeta'], "st_booking_option_type") ,
                    "allow_full_day" =>$this->radio_value_modify($this->get_key_data($n_result['postmeta'], "allow_full_day")) ,
                    "discount_rate" =>$this->get_key_data($n_result['postmeta'], "discount_rate") ,
                    "discount_by_day" =>$this->get_key_data($n_result['postmeta'], "discount_by_day") ,
                    "discount_type_no_day" =>$this->get_key_data($n_result['postmeta'], "discount_type_no_day") ,
                    "discount_type" =>$this->get_key_data($n_result['postmeta'], "discount_type") ,
                    "deposit_payment_status" =>$this->get_key_data($n_result['postmeta'], "deposit_payment_status") ,
                    "deposit_payment_amount" =>$this->get_key_data($n_result['postmeta'], "deposit_payment_amount") ,
                    "gallery" =>$this->comma_saprated_to_array($this->get_key_data($n_result['postmeta'], "gallery"),'gallery') ,
                    "video" =>$this->get_key_data($n_result['postmeta'], "video") ,
                    "room_facility_preview" =>$this->get_key_data($n_result['postmeta'], "room_facility_preview") ,
                    "disable_adult_name" =>$this->radio_value_modify($this->get_key_data($n_result['postmeta'], "disable_adult_name") ),
                    "disable_children_name" =>$this->radio_value_modify($this->get_key_data($n_result['postmeta'], "disable_children_name")) ,
                    "bed_number" =>$this->get_key_data($n_result['postmeta'], "bed_number") ,
                    "bath_number" =>$this->get_key_data($n_result['postmeta'], "bath_number") ,
                    "room_footage" =>$this->get_key_data($n_result['postmeta'], "room_footage") ,
                    "st_room_external_booking" =>$this->radio_value_modify($this->get_key_data($n_result['postmeta'], "st_room_external_booking")) ,
                    "st_room_external_booking_link" =>$this->get_key_data($n_result['postmeta'], "st_room_external_booking_link") ,
                    "add_new_facility" =>$this->get_key_data($n_result['postmeta'], "add_new_facility") ,
                    "room_description" =>$this->get_key_data($n_result['postmeta'], "room_description") ,
                    "defaulte_status" =>$this->get_key_data($n_result['postmeta'], "defaulte_status") ,
                    "calendar_check_in" =>$this->get_key_data($n_result['postmeta'], "calendar_check_in") ,
                    "calendar_check_out" =>$this->get_key_data($n_result['postmeta'], "calendar_check_out") ,
                    "calendar_price" =>$this->get_key_data($n_result['postmeta'], "calendar_price") ,
                    "calendar_status" =>$this->get_key_data($n_result['postmeta'], "calendar_status") ,
                    "st_allow_cancel" =>$this->radio_value_modify($this->get_key_data($n_result['postmeta'], "st_allow_cancel")) ,
                    "st_cancel_number_days" =>$this->get_key_data($n_result['postmeta'], "st_cancel_number_days") ,
                    "st_cancel_percent" =>$this->get_key_data($n_result['postmeta'], "st_cancel_percent") ,
                    "ical_url" =>$this->get_key_data($n_result['postmeta'], "ical_url") ,
                    "is_meta_payment_gateway_st_submit_form" =>$this->radio_value_modify($this->get_key_data($n_result['postmeta'], "is_meta_payment_gateway_st_submit_form")) ,
                    "social_links" => json_encode( [
                        "facebook_custom_link" => $this->get_key_data($n_result['postmeta'],'facebook_custom_link'),
                        "twitter_custom_link" => $this->get_key_data($n_result['postmeta'],'twitter_custom_link'),
                        "instagram_custom_link" => $this->get_key_data($n_result['postmeta'],'instagram_custom_link'),
                        "you_tube_custom_link" => $this->get_key_data($n_result['postmeta'],'you_tube_custom_link')
                    ]) ,
                    "created_at" => $n_result["post_date_gmt"],
                    "updated_at" => $n_result["post_modified_gmt"]
                ];
                $roomDetails->push($roomDetail);

            }

            RoomDetail::insert($roomDetails->toArray());
            $recourd_count = $recourd_count+200;
            $this->info("$recourd_count Record Loaded");

        }

        $this->info("room Details Loaded");
    }

    public function load_activity_details() {
        $this->info("activity Details Loading...");
        $post_collections = DB::connection($this->wp_connection)->table("wp_st_activity")->select("post_id")->get();
        $postIds = $post_collections->pluck('post_id')->toArray();

        $activityIds = Activity::whereIn("wp_id", $postIds)->select("wp_id", "id")->pluck('id', 'wp_id');
        $recourd_count = 0;
        foreach (array_chunk($postIds, 200) as $pIds) {

            // Get Postmeta
            $pQuery = DB::connection($this->wp_connection)->table('wp_posts as p')
            ->select('p.*', 'pm.*')
            ->join('wp_postmeta as pm', 'pm.post_id', '=', 'p.ID')
            ->whereIn('pm.meta_key', [
                'map_type', 'st_google_map', "map_lat","map_lng","map_zoom","enable_street_views_google_map","gallery","video","contact_email","contact_phone","contact_fax","contact_web","venue_facilities","activity_include","activity_exclude","activity_highlight","activity_program_style","activity_program","activity_program_bgr","activity_faq","calendar_check_in","calendar_check_out","calendar_adult_price","calendar_child_price","calendar_infant_price","calendar_starttime_hour","calendar_starttime_minute","calendar_starttime_format","calendar_status","calendar_groupday","st_allow_cancel","st_cancel_number_days","st_cancel_percent","is_meta_payment_gateway_st_submit_form","child_policy","booking_policy","refund_and_cancellation_policy","st_activity_external_booking_link","activity_zones","st_activity_corporate_address","st_activity_short_address","facebook_custom_link","twitter_custom_link","instagram_custom_link","you_tube_custom_link","properties_near_by"
            ])
            ->whereIn('p.ID', $pIds)
            ->orderBy('p.ID', 'desc');
            $results = $pQuery->get();
            $nestedResults = [];
            $serializer_fields = ["activity_program","activity_program_bgr","activity_faq","activity_zones","properties_near_by"];
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



                if (in_array($metaKey, $serializer_fields)) {
                    // Serialized Results
                    $nestedResults[$postId]['postmeta'][$metaKey] = $this->unserialize_data_format_in_array($metaValue, $metaKey);
                } else {
                    $nestedResults[$postId]['postmeta'][$metaKey] = $metaValue;
                }
            }

            $tourDetails = collect([]);
            // Directly insert into $tourDetails


            foreach($nestedResults as $postId => $n_result){

                $activityId = $activityIds[$postId];


                $latitude = $this->get_key_data($n_result['postmeta'], "map_lat");
                $longitude = $this->get_key_data($n_result['postmeta'], "map_lng");


                $tourDetail = [
                    "activity_id"  =>  $activityId,
                    "map_address"  =>  $this->geolocationaddress($latitude,$longitude),
                    "latitude" => $this->get_key_data($n_result['postmeta'], "map_lat"),
                    "longitude" => $this->get_key_data($n_result['postmeta'], "map_lng"),
                    "zoom_level" => $this->get_key_data($n_result['postmeta'], "map_zoom"),
                    "enable_street_views_google_map"  =>  $this->get_key_data($n_result["postmeta"],"enable_street_views_google_map"),
                    "gallery"  =>  $this->comma_saprated_to_array($this->get_key_data($n_result['postmeta'], "gallery"),'gallery'),
                    "video"  =>  $this->get_key_data($n_result["postmeta"],"video"),
                    "contact"  =>  json_encode([
                        "email" =>$this->get_key_data($n_result["postmeta"], "contact_email"),
                        "phone" =>$this->get_key_data($n_result["postmeta"], "contact_phone"),
                        "fax" =>$this->get_key_data($n_result["postmeta"], "contact_fax"),
                        "website" =>$this->get_key_data($n_result["postmeta"], "contact_web"),
                        "show_agent_contact_info" =>$this->get_key_data($n_result["postmeta"], "show_agent_contact_info")
                    ]),
                    "venue_facilities"  =>  $this->get_key_data($n_result["postmeta"],"venue_facilities"),
                    "activity_include"  =>  $this->get_key_data($n_result["postmeta"],"activity_include"),
                    "activity_exclude"  =>  $this->get_key_data($n_result["postmeta"],"activity_exclude"),
                    "activity_highlight"  =>  $this->get_key_data($n_result["postmeta"],"activity_highlight"),
                    "activity_program_style"  =>  $this->get_key_data($n_result["postmeta"],"activity_program_style"),
                    "activity_program"  =>  $this->get_key_data($n_result["postmeta"],"activity_program"),
                    "activity_program_bgr"  =>  $this->get_key_data($n_result["postmeta"],"activity_program_bgr"),
                    "activity_faq"  =>  $this->get_key_data($n_result["postmeta"],"activity_faq"),
                    "calendar_check_in"  =>  $this->get_key_data($n_result["postmeta"],"calendar_check_in"),
                    "calendar_check_out"  =>  $this->get_key_data($n_result["postmeta"],"calendar_check_out"),
                    "calendar_adult_price"  =>  $this->get_key_data($n_result["postmeta"],"calendar_adult_price"),
                    "calendar_child_price"  =>  $this->get_key_data($n_result["postmeta"],"calendar_child_price"),
                    "calendar_infant_price"  =>  $this->get_key_data($n_result["postmeta"],"calendar_infant_price"),
                    "calendar_starttime_hour"  =>  $this->get_key_data($n_result["postmeta"],"calendar_starttime_hour"),
                    "calendar_starttime_minute"  =>  $this->get_key_data($n_result["postmeta"],"calendar_starttime_minute"),
                    "calendar_starttime_format"  =>  $this->get_key_data($n_result["postmeta"],"calendar_starttime_format"),
                    "calendar_status"  =>  $this->get_key_data($n_result["postmeta"],"calendar_status"),
                    "calendar_groupday"  =>  $this->get_key_data($n_result["postmeta"],"calendar_groupday"),
                    "st_allow_cancel"  =>  $this->get_key_data($n_result["postmeta"],"st_allow_cancel"),
                    "st_cancel_number_days"  =>  $this->get_key_data($n_result["postmeta"],"st_cancel_number_days"),
                    "st_cancel_percent"  =>  $this->get_key_data($n_result["postmeta"],"st_cancel_percent"),
                    "ical_url"  =>  $this->get_key_data($n_result["postmeta"],"ical_url"),
                    "is_meta_payment_gateway_st_submit_form"  =>  $this->get_key_data($n_result["postmeta"],"is_meta_payment_gateway_st_submit_form"),
                    "child_policy"  =>  $this->get_key_data($n_result["postmeta"],"child_policy"),
                    "booking_policy"  =>  $this->get_key_data($n_result["postmeta"],"booking_policy"),
                    "refund_and_cancellation_policy"  =>  $this->get_key_data($n_result["postmeta"],"refund_and_cancellation_policy"),
                    "country"  =>  $this->get_key_data($n_result["postmeta"],"st_activity_country"),
                    "st_activity_external_booking_link"  =>  $this->get_key_data($n_result["postmeta"],"st_activity_external_booking_link"),
                    "activity_zones"  =>  $this->get_key_data($n_result["postmeta"],"activity_zones"),
                    "st_activity_corporate_address"  =>  $this->get_key_data($n_result["postmeta"],"st_activity_corporate_address"),
                    "st_activity_short_address"  =>  $this->get_key_data($n_result["postmeta"],"st_activity_short_address"),
                    "social_links"  =>  json_encode( [
                        "facebook_custom_link" => $this->get_key_data($n_result['postmeta'],'facebook_custom_link'),
                        "twitter_custom_link" => $this->get_key_data($n_result['postmeta'],'twitter_custom_link'),
                        "instagram_custom_link" => $this->get_key_data($n_result['postmeta'],'instagram_custom_link'),
                        "you_tube_custom_link" => $this->get_key_data($n_result['postmeta'],'you_tube_custom_link')
                    ]),
                    "properties_near_by"  =>  $this->get_key_data($n_result["postmeta"],"properties_near_by"),
                    "created_at" => $n_result["post_date_gmt"],
                    "updated_at" => $n_result["post_modified_gmt"]
                ];
                $tourDetails->push($tourDetail);

            }

            ActivityDetail::insert($tourDetails->toArray());
            $recourd_count = $recourd_count+200;
            $this->info("$recourd_count Record Loaded");

        }

        $this->info("Activity Details Loaded");
    }



    public function update_tour_migrate()
    {

         $this->info("Tour Data update...");
        $post_collections = Tour::get(['id','wp_id']);
        $wp_ids = $post_collections->pluck('wp_id')->toArray();

        

        $pQuery = DB::connection($this->wp_connection)->table('wp_postmeta')
        ->select('*')
        ->whereIn('meta_key', ["show_agent_contact_info","email","phone","fax","website"])
        ->whereIn('post_id', $wp_ids)
        ->orderBy('meta_id', 'desc');

        $results = $pQuery->get();
        $nestedResults = [];
        foreach ($results as $result) {
            $postId = $result->post_id;
                unset($result->post_id); // Remove the ID field from the main post data

            if (!isset($nestedResults[$postId])) {
                $nestedResults[$postId] = (array) $result;
                $nestedResults[$postId]['postmeta'] = [];
            }

            $metaKey = $result->meta_key;
            $metaValue = $result->meta_value;

                unset($result->meta_key, $result->meta_value); // Remove meta_key and meta_value fields

                $nestedResults[$postId]['postmeta'][$metaKey] = $metaValue;
                
            }

            if (!empty($nestedResults)) {
                foreach ($nestedResults as $postId => $n_result) {
                 $tourSingle = Tour::where('wp_id',$postId)->first();

           

                  $tour = [

                     "contact" => json_encode([
                        "info" => $this->get_key_data($n_result['postmeta'], "show_agent_contact_info"),
                        "email" => $this->get_key_data($n_result['postmeta'], "email"),
                        "phone" => $this->get_key_data($n_result['postmeta'], "phone"),
                        "fax" => $this->get_key_data($n_result['postmeta'], "fax"),
                        "website" => $this->get_key_data($n_result['postmeta'], "website")
                    ]),

                 ];
                
                $tourSingle->detail()->update($tour);

             }
         }


            $this->info("Tour Data updated");


     }
    /**
     * Tour Module
     */
    public function tour_migrate()
    {
        $this->info("Tour Data Loading...");
        $post_collections = DB::connection($this->wp_connection)->table("wp_st_tours")->select("post_id")->get();
        $postIds = $post_collections->pluck('post_id')->toArray();

        foreach (array_chunk($postIds, 200) as $pIds) {

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
            $serializer_fields = ['discount_by_child', 'discount_by_adult', 'extra_price'];
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

                if (in_array($metaKey, $serializer_fields)) {
                    // Serialized Results
                    $nestedResults[$postId]['postmeta'][$metaKey] = $this->unserialize_data_format_in_array($metaValue, $metaKey);
                } else {
                    $nestedResults[$postId]['postmeta'][$metaKey] = $metaValue;
                }
            }


            // TODO: Can think better way
            // One more iteration for Laravel Specific
            $tours = collect([]);
            if (!empty($nestedResults)) {
                foreach ($nestedResults as $postId => $n_result) {
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
                        "featured_image" => $this->string_to_json($this->get_key_data($n_result["postmeta"], "_thumbnail_id"), 'image_id'),
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
                        'status' => 1

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
    public function file_migrate()
    {
        $this->info("File Data Loading...");
        $post_collections = DB::connection($this->wp_connection)->table("wp_as3cf_items")->select("source_id")->get();
        $postIds = $post_collections->pluck('source_id')->toArray();


        $test_count = 0;
        foreach (array_chunk($postIds, 200) as $pIds) {

            $pQuery = DB::connection($this->wp_connection)->table('wp_as3cf_items as wp_as3')
            ->whereIn('wp_as3.source_id', $pIds)
            ->select('wp_as3.source_id', 'wp_posts.*')
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
            if (!empty($nestedResults)) {
                foreach ($nestedResults as $postId => $n_result) {
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
    public function media_migrate()
    {
        $this->info("Media Data Loading...");
        $post_collections = DB::connection($this->wp_connection)->table("wp_as3cf_items")->select("source_id")->get();
        $postIds = $post_collections->pluck('source_id')->toArray();

        foreach (array_chunk($postIds, 200) as $pIds) {

            $pQuery = DB::connection($this->wp_connection)->table('wp_posts as p')
            ->select('p.*', 'pm.*', 'wp_as3cf_items.*')
            ->leftJoin("wp_as3cf_items", "wp_as3cf_items.source_id", '=', 'p.ID')
            ->join('wp_postmeta as pm', 'pm.post_id', '=', 'p.ID')
            ->whereIn('pm.meta_key', ['as3cf_filesize_total', '_wp_attachment_metadata'])
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

                if (in_array($metaKey, $serializer_fields)) {
                    // Serialized Results
                    $nestedResults[$postId]['postmeta'][$metaKey] = $this->unserialize_data_format_in_array($metaValue);
                } else {
                    $nestedResults[$postId]['postmeta'][$metaKey] = $metaValue;
                }
            }
            //dump($nestedResults);

            // TODO: Can think better way
            // One more iteration for Laravel Specific
            $media_s = collect([]);
            if (!empty($nestedResults)) {
                foreach ($nestedResults as $postId => $n_result) {
                    $model = File::where('wp_id', $postId)->first();
                    $media = [
                        "model_type" => "App\Models\File",
                        "model_id" =>  $model->id,
                        "uuid" =>   Str::uuid(),
                        "collection_name" => 'images',
                        "name" => $n_result["post_title"],
                        "file_name" => $this->get_image_name($n_result["source_path"], 'image'),
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
    public function location_migrate()
    {
        $this->info("Location Data Loading...");
        $results = DB::connection($this->wp_connection)->table('wp_posts as p')
        ->select('p.*', 'pm.*')
        ->join('wp_postmeta as pm', 'pm.post_id', '=', 'p.ID')
        ->whereIn('pm.meta_key', ["color", "location_country", "zipcode", "map_lat", "map_lng", "map_zoom", "map_type", "is_featured", "_thumbnail_id"])
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
        if (!empty($nestedResults)) {
            foreach ($nestedResults as $postId => $n_result) {
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

                    "map_address" => $this->geolocationaddress($this->get_key_data($n_result["postmeta"], "map_lat"), $this->get_key_data($n_result["postmeta"], "map_lng")),

                    "is_featured" => $this->get_key_data($n_result["postmeta"], "is_featured"),
                    "parent_id" => $n_result["post_parent"],
                    "menu_order" => $n_result["menu_order"],
                    "logo" => $this->get_key_data($n_result["postmeta"], "logo"),

                    "featured_image" => $this->string_to_json($this->get_key_data($n_result["postmeta"], "_thumbnail_id"), 'image_id'),
                    "status" => 1,
                    "created_at" => $n_result["post_date_gmt"],
                    "updated_at" => $n_result["post_modified"]

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
    public function location_meta_migrate()
    {
        $this->info("Location Meta Data Loading...");

        $post_collections = Location::select("wp_id")->get();
        $postIds = $post_collections->pluck('wp_id')->toArray();
        foreach (array_chunk($postIds, 5) as $pIds) {
            $results = DB::connection($this->wp_connection)->table('wp_posts as p')
            ->select('p.ID as ID', 'p.post_date_gmt', 'p.post_modified_gmt', 'pm.*')
            ->join('wp_postmeta as pm', 'pm.post_id', '=', 'p.ID')
            ->where('pm.meta_value', '!=', '')
            ->whereIn('pm.meta_key', ["helpful_facts", "place_to_visit", "place_to_visit_description", "best_time_to_visit", "best_time_to_visit_description", "how_to_reach", "how_to_reach_description", "fair_and_festivals", "fair_and_festivals_image", "fair_and_festivals_description", "culinary_retreat", "culinary_retreat_description", "shopaholics_anonymous", "shopaholics_anonymous_description", "weather", "location_map", "what_to_do", "get_to_know", "get_to_know_image", "save_your_pocket", "save_your_pocket_image", "save_your_environment", "save_your_environment_image", "faqs", "by_aggregators", "b_govt_subsidiaries", "by_hotels", "gallery", "location_video", "hotel_activities", "location_packages", "important_note", "sanstive_data", "hotel_locations", "color", "location_for_filter", "child_tabs"])
            ->where('p.post_type', 'location')
            ->where('p.post_status', 'publish')
            ->whereIn('p.ID', $pIds)
            ->orderBy('p.ID', 'desc')
            ->get();

            $nestedResults = [];
            $serializer_fields =  [
                "place_to_visit", "best_time_to_visit", "how_to_reach", "fair_and_festivals", "culinary_retreat", "shopaholics_anonymous", "weather", "location_map", "what_to_do", "get_to_know", "save_your_pocket", "save_your_environment", "faqs", "by_aggregators", "b_govt_subsidiaries", "by_hotels", "hotel_activities", "location_for_filter", "location_tab_item", "child_tabs"

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


                if (in_array($metaKey, $serializer_fields)) {
                    // Serialized Results
                    $nestedResults[$postId]['postmeta'][$metaKey] = $this->unserialize_data_format_in_array($metaValue, $metaKey);
                } else {
                    $nestedResults[$postId]['postmeta'][$metaKey] = $metaValue;
                }
            }


            // TODO: Can think better way
            // One more iteration for Laravel Specific
            $location_metas = collect([]);
            if (!empty($nestedResults)) {
                foreach ($nestedResults as $postId => $n_result) {

                    $location_content = [
                        'st_location_use_build_layout' => $this->radio_value_modify($this->get_key_data($n_result["postmeta"], "st_location_use_build_layout")),
                        'is_gallery' => $this->radio_value_modify($this->get_key_data($n_result["postmeta"], "location_tab_item")),
                        'location_gallery_style' => $this->get_key_data($n_result["postmeta"], "location_gallery_style"),
                        'image_count' => $this->get_key_data($n_result["postmeta"], "image_count"),
                        'st_gallery' => $this->comma_saprated_to_array($this->get_key_data($n_result["postmeta"], "st_gallery"), 'gallery'),
                        'is_tabs' => $this->radio_value_modify($this->get_key_data($n_result["postmeta"], "is_tabs")),
                        'tab_position' => $this->get_key_data($n_result["postmeta"], "location_tab_item"),
                        'location_tab_item' => $this->get_key_data($n_result["postmeta"], 'location_tab_item')

                    ];
                    $location_data = Location::where('wp_id', $postId)->first();
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
                        "fair_and_festivals_image" => $this->string_to_json($this->get_key_data($n_result["postmeta"], "fair_and_festivals_image"), 'image'),
                        "fair_and_festivals_description" => $this->get_key_data($n_result["postmeta"], "fair_and_festivals_description"),
                        "culinary_retreat" => $this->get_key_data($n_result["postmeta"], "culinary_retreat"),
                        "culinary_retreat_description" => $this->get_key_data($n_result["postmeta"], "culinary_retreat_description"),
                        "shopaholics_anonymous" => $this->get_key_data($n_result["postmeta"], "shopaholics_anonymous"),
                        "shopaholics_anonymous_description" => $this->get_key_data($n_result["postmeta"], "shopaholics_anonymous_description"),
                        "weather" => $this->get_key_data($n_result["postmeta"], "weather"),
                        "location_map" => $this->get_key_data($n_result["postmeta"], "location_map"),
                        "what_to_do" => $this->get_key_data($n_result["postmeta"], "what_to_do"),
                        "get_to_know" => $this->get_key_data($n_result["postmeta"], "get_to_know"),
                        "get_to_know_image" =>  $this->string_to_json($this->get_key_data($n_result["postmeta"], "get_to_know_image"), 'image'),
                        "save_your_pocket" => $this->get_key_data($n_result["postmeta"], "save_your_pocket"),
                        "save_your_pocket_image" => $this->string_to_json($this->get_key_data($n_result["postmeta"], "save_your_pocket_image"), 'image'),
                        "save_your_environment" => $this->get_key_data($n_result["postmeta"], "save_your_environment"),
                        "save_your_environment_image" => $this->string_to_json($this->get_key_data($n_result["postmeta"], "save_your_environment_image"), 'image'),
                        "faqs" => $this->get_key_data($n_result["postmeta"], "faqs"),
                        "by_aggregators" => $this->get_key_data($n_result["postmeta"], "by_aggregators"),
                        "b_govt_subsidiaries" => $this->get_key_data($n_result["postmeta"], "b_govt_subsidiaries"),
                        "by_hotels" => $this->get_key_data($n_result["postmeta"], "by_hotels"),
                        "gallery" => $this->comma_saprated_to_array($this->get_key_data($n_result["postmeta"], "location_gallery"), 'gallery'),
                        "location_video" => $this->extract_shortcode($this->get_key_data($n_result["postmeta"], "location_video"), 'video'),
                        "hotel_activities" => $this->get_key_data($n_result["postmeta"], "by_hotels"),
                        "location_packages" => "[]",
                        "important_note" => $this->get_key_data($n_result["postmeta"], "important_note"),
                        "sanstive_data" => $this->get_key_data($n_result["postmeta"], "sanstive_data"),
                        "hotel_locations" => $this->get_key_data($n_result["postmeta"], "hotel_locations"),
                        "color" => $this->get_key_data($n_result["postmeta"], "color"),
                        "location_for_filter" => $this->get_key_data($n_result["postmeta"], "location_for_filter"),
                        'packages' => 'tour',
                        'stay' => 'hotel',
                        'child_tabs' => $this->get_key_data($n_result["postmeta"], "child_tabs"),
                        "created_at" => $n_result["post_date_gmt"],
                        "updated_at" => $n_result["post_modified_gmt"]

                    ];

                    $location_metas->push($location_meta);
                }

                LocationMeta::insert($location_metas->toArray());
                $this->info("Location 5 Details Loaded");
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
        ->whereIn('pm.meta_key', [
            "country_zone_title", "country", "country_zone_icon", "country_zone_image", "country_description", "country_zone_section", "country_zone_catering_title",
            "custom_country_zone_catering_url"
        ])
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

            if (in_array($metaKey, $serializer_fields)) {
                // Serialized Results
                $nestedResults[$postId]['postmeta'][$metaKey] = $this->unserialize_data_format_in_array($metaValue, $metaKey);
            } else {
                $nestedResults[$postId]['postmeta'][$metaKey] = $metaValue;
            }
        }

        // TODO: Can think better way
        // One more iteration for Laravel Specific
        $country_zones = collect([]);
        if (!empty($nestedResults)) {
            foreach ($nestedResults as $postId => $n_result) {


                $coutry_zone_catering = [
                    "title" => $this->get_key_data($n_result["postmeta"], "country_zone_catering_title"),
                    "url" => $this->get_key_data($n_result["postmeta"], "custom_country_zone_catering_url")
                ];
                $country_zone = [
                    "wp_id" => $postId,
                    "title" => $n_result["post_title"],
                    "description" => $n_result["post_content"],
                    "excerpt" => $n_result["post_excerpt"],
                    "slug" => $n_result["post_name"],
                    "sub_title" => $this->get_key_data($n_result["postmeta"], "country_zone_title"),
                    "country" => $this->get_key_data($n_result["postmeta"], "country"),
                    "icon" => $this->string_to_json($this->get_key_data($n_result["postmeta"], "country_zone_icon"), 'image'),
                    "image" => $this->string_to_json($this->get_key_data($n_result["postmeta"], "country_zone_image"), 'image'),
                    "country_zone_description" => $this->get_key_data($n_result["postmeta"], "country_description"),
                    "country_zone_section" => $this->get_key_data($n_result["postmeta"], "country_zone_section"),
                    "country_zone_catering" => json_encode($coutry_zone_catering),
                    "created_by" => $n_result["post_author"],
                    "status" => 1,
                    "created_at" => $n_result["post_date_gmt"],
                    "updated_at" => $n_result["post_modified"]
                ];

                $country_zones->push($country_zone);
            }
            //dd($locations->toArray());
            CountryZone::insert($country_zones->toArray());
        }

        $this->info("Country Zone Data Loading Completed");
    }


    /*tourism zone migration*/

    public function st_tourism_zones_migration()
    {
        $this->info("tourism zones Data Loading...");
        $get_tour = DB::connection($this->wp_connection)->table('wp_posts')->where('post_type', 'st_tourism_zones')->get('ID');
        $postIds = $get_tour->pluck('ID')->toArray();
        $results = DB::connection($this->wp_connection)->table('wp_posts as p')
        ->select('p.*', 'pm.*')
        ->where('p.post_type', 'st_tourism_zones')
        ->where('p.post_status', 'publish')
        ->join('wp_postmeta as pm', 'pm.post_id', '=', 'p.ID')
        ->whereIn('pm.meta_key', [
            "tourism_zone_title","tourism_zone_image", "tourism_zone_description", "tourism_zone", "state",
        ])
        ->orderBy('p.ID', 'desc')->get();
       

        // Build 500 Objects
        $nestedResults = [];
        $serializer_fields =  ["tourism_zone"];

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
               

            if (in_array($metaKey, $serializer_fields)) {
                // Serialized Results
                dump($metaKey);
                $nestedResults[$postId]['postmeta'][$metaKey] = $this->unserialize_data_format_in_array($metaValue, $metaKey);
            } else {
                $nestedResults[$postId]['postmeta'][$metaKey] = $metaValue;
            }
        }
    
        
        // TODO: Can think better way
        // One more iteration for Laravel Specific
        $tourism_zones = collect([]);
        if (!empty($nestedResults)) {
            foreach ($nestedResults as $postId => $n_result) {
                $wp_state = $this->get_key_data($n_result["postmeta"], "state");
                $state = State::where('wp_taxonomy_id',$wp_state)->first();
                $user = User::where('wp_id',$n_result["post_author"])->first();
                $tourism_zone = [
                    "wp_id" => $postId,
                    "title" => $n_result["post_title"],
                    "description" => $this->check_content($n_result["post_content"], $postId, 'st_tourism_zones'),
                    "excerpt" => $n_result["post_excerpt"],
                    "slug" => $n_result["post_name"],
                    "sub_title" => $this->get_key_data($n_result["postmeta"], "tourism_zone_title"),
                    "state_id" => (!empty($state))?$state->id:0,
                    "image" => $this->string_to_json($this->get_key_data($n_result["postmeta"], "tourism_zone_image"), 'image'),
                    "tourism_zone_description" => $this->get_key_data($n_result["postmeta"], "tourism_zone_description"),
                    "tourism_zone" => $this->get_key_data($n_result["postmeta"], "tourism_zone"),

                    "created_by" => (!empty($user))?$user->id:0,
                    "status" => 1,
                    "created_at" => $n_result["post_date_gmt"],
                    "updated_at" => $n_result["post_modified"]
                ];

                $tourism_zones->push($tourism_zone);
            }
            //dd($locations->toArray());
            TourismZone::insert($tourism_zones->toArray());
        }

        $this->info("tourism Zone Data Loading Completed");
    }

    /*Activity Package module migration*/

    public function st_activity_package_migration()
    {
        $this->info("Activity Package modules Data Loading...");

        $post_collections = DB::connection($this->wp_connection)->table("wp_posts")->select("ID")->where('post_type', 'st_activity_packages')->get();
        $postIds = $post_collections->pluck('ID')->toArray();
        foreach (array_chunk($postIds, 200) as $pIds) {

            $results = DB::connection($this->wp_connection)->table('wp_posts as p')
            ->select('p.*', 'pm.*')
            ->join('wp_postmeta as pm', 'pm.post_id', '=', 'p.ID')
            ->whereIn('pm.meta_key', ["duration","price","amenities","custom_icon"])
            ->where('p.post_type', 'st_activity_packages')
            ->where('p.post_status', 'publish')
            ->whereIn('p.ID', $pIds)
            ->orderBy('p.ID', 'desc')

            ->get();

        // Build 200 Objects
            $nestedResults = [];
        // $serializer_fields =  ["activity_package_section"];

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
        $activity_packages = collect([]);
        if (!empty($nestedResults)) {
            foreach ($nestedResults as $postId => $n_result) {

                $activity_package = [
                    "wp_id" => $postId,
                    "title" => $n_result["post_title"],
                    "description" => $this->check_content($n_result["post_content"], $postId, 'st_activity_packages'),
                    "excerpt" => $n_result["post_excerpt"],
                    "slug" => $n_result["post_name"],

                    "duration" => $this->get_key_data($n_result["postmeta"], "duration"),
                    "price" => $this->get_key_data($n_result["postmeta"], "price"),
                    "amenities" => $this->get_key_data($n_result["postmeta"], "amenities"),
                    "custom_icon" => $this->get_key_data($n_result["postmeta"], "custom_icon"),
                    "created_by" => $n_result["post_author"],
                    "status" => 1,
                    "created_at" => $n_result["post_date_gmt"],
                    "updated_at" => $n_result["post_modified"]
                ];

                $activity_packages->push($activity_package);
            }
            //dd($locations->toArray());
            ActivityPackage::insert($activity_packages->toArray());
            $this->info("Activity Package 200 done");
        }

    }

    $this->info("Activity Package module Data Loading Completed");
}


/*activity zone migration*/

public function st_activity_zones_migration()
{
    $this->info("activity zones Data Loading...");
    $results = DB::connection($this->wp_connection)->table('wp_posts as p')
    ->select('p.*', 'pm.*')
    ->join('wp_postmeta as pm', 'pm.post_id', '=', 'p.ID')
    ->whereIn('pm.meta_key', [
        "activity_zone_title", "activity_zone_image", "activity_description", "activity_zone_section","activity_zone_pdf"
    ])
    ->where('p.post_type', 'st_activity_zones')
    ->where('p.post_status', 'publish')
    ->orderBy('p.ID', 'desc')

    ->get();

        // Build 500 Objects
    $nestedResults = [];
    $serializer_fields =  ["activity_zone_section"];

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

            if (in_array($metaKey, $serializer_fields)) {
                // Serialized Results
                $nestedResults[$postId]['postmeta'][$metaKey] = $this->unserialize_data_format_in_array($metaValue, $metaKey);
            } else {
                $nestedResults[$postId]['postmeta'][$metaKey] = $metaValue;
            }
        }

        // TODO: Can think better way
        // One more iteration for Laravel Specific
        $activity_zones = collect([]);
        if (!empty($nestedResults)) {
            foreach ($nestedResults as $postId => $n_result) {

                $activity_zone = [
                   "wp_id" => $postId,
                   "title" => $n_result["post_title"],
                   "description" => $n_result["post_content"],
                   "excerpt" => $n_result["post_excerpt"],
                   "slug" => $n_result["post_name"],
                   "sub_title" => $this->get_key_data($n_result["postmeta"], "activity_zone_title"),
                   "country" => $this->get_key_data($n_result["postmeta"], "country"),
                   "image" => $this->string_to_json($this->get_key_data($n_result["postmeta"], "activity_zone_image"), 'image'),
                   "activity_zone_description" => $this->get_key_data($n_result["postmeta"], "activity_description"),
                   "activity_zone_section" => $this->get_key_data($n_result["postmeta"], "activity_zone_section"),
                   "activity_zone_pdf" => $this->get_key_data($n_result["postmeta"], "activity_zone_pdf"),

                   "created_by" => $n_result["post_author"],
                   "status" => 1,
                   "created_at" => $n_result["post_date_gmt"],
                   "updated_at" => $n_result["post_modified"]
               ];

               $activity_zones->push($activity_zone);
           }
            //dd($locations->toArray());
           ActivityZone::insert($activity_zones->toArray());
       }

       $this->info("activity Zone Data Loading Completed");
   }

   /*Activity Lists module migration*/

   public function st_activity_lists_migration()
   {
    $this->info("Activity Lists modules Data Loading...");

    $post_collections = DB::connection($this->wp_connection)->table("wp_posts")->select("ID")->where('post_type','st_activity_lists')->get();
    $postIds = $post_collections->pluck('ID')->toArray();

    foreach (array_chunk($postIds, 200) as $pIds) {
        $results = DB::connection($this->wp_connection)->table('wp_posts as p')
        ->select('p.*', 'pm.*')
        ->join('wp_postmeta as pm', 'pm.post_id', '=', 'p.ID')
        ->whereIn('pm.meta_key', ["custom_icon"])
        ->where('p.post_type', 'st_activity_lists')
        ->where('p.post_status', 'publish')
        ->whereIn('p.ID', $pIds)
        ->orderBy('p.ID', 'desc')

        ->get();

        // Build 200 Objects
        $nestedResults = [];
        // $serializer_fields =  ["activity_lists_section"];

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
        $activity_lists = collect([]);
        if (!empty($nestedResults)) {
            foreach ($nestedResults as $postId => $n_result) {

                $activity_list = [
                    "wp_id" => $postId,
                    "title" => $n_result["post_title"],
                    "description" => $this->check_content($n_result["post_content"], $postId, 'st_activity_lists'),
                    "excerpt" => $n_result["post_excerpt"],
                    "slug" => $n_result["post_name"],
                    "custom_icon" => $this->get_key_data($n_result["postmeta"], "custom_icon"),
                    "created_by" => $n_result["post_author"],
                    "status" => 1,
                    "created_at" => $n_result["post_date_gmt"],
                    "updated_at" => $n_result["post_modified"]
                ];

                $activity_lists->push($activity_list);
            }
            //dd($locations->toArray());
            ActivityLists::insert($activity_lists->toArray());
            $this->info("Activity Lists module Data 200 done");
        }
    }

    $this->info("Activity Lists module Data Loading Completed");
}


public function wp_option_get_value($key)
{
    $result = "";
    $wp_option = DB::connection($this->wp_connection)->table('wp_options')
    ->select('*')
    ->where('wp_options.option_name', '=', $key)
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
        if ($this->tourist_is_serialized($value)) {
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
        if ($this->tourist_is_serialized($value)) {
            $unserialize = unserialize($value);
            if (is_array($unserialize)) {
                if (isset($unserialize[0])) {

                    $result = $unserialize[0];
                }
            }
        } else {
            $result = $value;
        }
    }
    return $result;
}

public function setup_types()
{
    $this->info("Terms Type Data Loading...");
    foreach ($this->term_category_dictionary as $type => $term_values) {
        $type_list = collect([]);

        $results = DB::connection($this->wp_connection)->table('wp_terms as wt')
        ->select('wt.*', 'wtt.*', 'wtm.meta_key', 'wtm.meta_value')

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

            if (!empty($nestedResults)) {
                foreach ($nestedResults as $termId => $n_result) {
                    $tax_met_value = 'tax_meta_' . $n_result['term_taxonomy_id'];
                    $single_type = [
                        "name" => $n_result['name'],
                        "slug" => $n_result['slug'],

                        "parent_id" => 0, // We will set it
                        "description" => $n_result['description'],
                        "type" => $type,
                        "wp_term_id" => $termId,
                        "lebal_type" => $this->get_key_data($n_result["termmeta"], "st_label"),
                        "attachment" => $this->get_key_data($n_result["termmeta"], "st_tour_type_image"),
                        "icon" => $this->wp_term_icon_refind($this->wp_option_get_value($tax_met_value)),
                        "wp_taxonomy_id" => $n_result['term_taxonomy_id']
                    ];

                    $type_list->push($single_type);
                }

                Type::insert($type_list->toArray());
            }
        }

        $this->info("Terms Type Data Loading Completed");
    }

    public function setup_package_types()
    {
        $this->info("Terms Package Type Data Loading...");

        foreach ($this->tour_package_type as $type => $term_values) {
            $package_type_list = collect([]);

            $results = DB::connection($this->wp_connection)->table('wp_terms as wt')
            ->select('wt.*', 'wtt.*', 'wtm.meta_key', 'wtm.meta_value')

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
            if (!empty($nestedResults)) {
                foreach ($nestedResults as $termId => $n_result) {
                    $tax_met_value = 'tax_meta_' . $n_result['term_taxonomy_id'];
                    $extra_data = [
                        "important_note" => $this->get_key_data($n_result["termmeta"], "important_note")
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
                        "extra_data" => json_encode($extra_data),
                        "wp_taxonomy_id" => $n_result['term_taxonomy_id']

                    ];

                    $package_type_list->push($single_package_type);
                }

                PackageType::insert($package_type_list->toArray());
            }
        }

        $this->info("Terms Package Type Data Loading Completed");
    }


    public function setup_language()
    {
        $this->info("Terms Language Data Loading...");
        $language_list = collect([]);
        $results = DB::connection($this->wp_connection)->table('wp_terms as wt')
        ->select('wt.*', 'wtt.*', 'wtm.meta_key', 'wtm.meta_value')

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



        if (!empty($nestedResults)) {
            foreach ($nestedResults as $termId => $n_result) {
                $tax_met_value = 'tax_meta_' . $n_result['term_taxonomy_id'];
                $single_language = [
                    "name" => $n_result['name'],
                    "slug" => $n_result['slug'],
                    "parent_id" => $n_result['parent'], // We will set it
                    "description" => $n_result['description'],
                    "wp_term_id" => $termId,
                    "icon" => $this->wp_term_icon_refind($this->wp_option_get_value($tax_met_value)),
                    "wp_taxonomy_id" => $n_result['term_taxonomy_id']
                ];

                $language_list->push($single_language);
            }



            Language::insert($language_list->toArray());
        }



        $this->info("Terms Language Data Loading Completed");
    }

    public function setup_attractions()
    {
        $this->info("Terms Attraction Data Loading...");
        $attractions_list = collect([]);
        $results = DB::connection($this->wp_connection)->table('wp_terms as wt')
        ->select('wt.*', 'wtt.*', 'wtm.meta_key', 'wtm.meta_value')

        ->join('wp_term_taxonomy as wtt', 'wt.term_id', '=', 'wtt.term_id')
        ->leftJoin('wp_termmeta as wtm', 'wt.term_id', '=', 'wtm.term_id')
        ->where('wtt.taxonomy', 'attractions')
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



        if (!empty($nestedResults)) {
            foreach ($nestedResults as $termId => $n_result) {
                $tax_met_value = 'tax_meta_' . $n_result['term_taxonomy_id'];
                $single_attraction = [
                    "name" => $n_result['name'],
                    "slug" => $n_result['slug'],
                    "parent_id" => $n_result['parent'], // We will set it
                    "description" => $n_result['description'],
                    'attraction_type'=>'Activity',
                    "wp_term_id" => $termId,
                    "icon" => $this->wp_term_icon_refind($this->wp_option_get_value($tax_met_value)),
                    "wp_taxonomy_id" => $n_result['term_taxonomy_id']
                ];

                $attractions_list->push($single_attraction);
            }



            Attraction::insert($attractions_list->toArray());
        }



        $this->info("Terms Attraction Data Loading Completed");
    }



    public function setup_term_activity_lists()
    {
        $this->info("Terms term activity list Data Loading...");
        $term_activity_lists = collect([]);
        $results = DB::connection($this->wp_connection)->table('wp_terms as wt')
        ->select('wt.*', 'wtt.*', 'wtm.meta_key', 'wtm.meta_value')

        ->join('wp_term_taxonomy as wtt', 'wt.term_id', '=', 'wtt.term_id')
        ->leftJoin('wp_termmeta as wtm', 'wt.term_id', '=', 'wtm.term_id')
        ->where('wtt.taxonomy', 'st-activities')
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



        if (!empty($nestedResults)) {
            foreach ($nestedResults as $termId => $n_result) {
                $tax_met_value = 'tax_meta_' . $n_result['term_taxonomy_id'];
                $single_term_activity_list = [
                    "name" => $n_result['name'],
                    "slug" => $n_result['slug'],
                    "parent" => $this->get_key_data($n_result['termmeta'],'activity_parent'), // We will set it
                    "description" => $n_result['description'],
                    "wp_term_id" => $termId,
                    "icon" => $this->wp_term_icon_refind($this->wp_option_get_value($tax_met_value)),
                    "wp_taxonomy_id" => $n_result['term_taxonomy_id']
                ];

                $term_activity_lists->push($single_term_activity_list);
            }



            TermActivityList::insert($term_activity_lists->toArray());
        }



        $this->info("Terms term activity list Data Loading Completed");
    }
    public function setup_places()
    {
        $this->info("Terms Place Data Loading...");
        $place_list = collect([]);
        $results = DB::connection($this->wp_connection)->table('wp_terms as wt')
        ->select('wt.*', 'wtt.*', 'wtm.meta_key', 'wtm.meta_value')

        ->join('wp_term_taxonomy as wtt', 'wt.term_id', '=', 'wtt.term_id')
        ->leftJoin('wp_termmeta as wtm', 'wt.term_id', '=', 'wtm.term_id')
        ->where('wtt.taxonomy', 'places')
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



        if (!empty($nestedResults)) {
            foreach ($nestedResults as $termId => $n_result) {
                $tax_met_value = 'tax_meta_' . $n_result['term_taxonomy_id'];
                $single_place = [
                    "name" => $n_result['name'],
                    "slug" => $n_result['slug'],
                    "parent_id" => $n_result['parent'], // We will set it
                    "description" => $n_result['description'],
                    "wp_term_id" => $termId,
                    "icon" => $this->wp_term_icon_refind($this->wp_option_get_value($tax_met_value)),
                    "wp_taxonomy_id" => $n_result['term_taxonomy_id']
                ];

                $place_list->push($single_place);
            }
            Place::insert($place_list->toArray());
        }
        $this->info("Terms Places Data Loading Completed");
    }

    public function associate_comman_relationship_table($objects, $terms, $term_rel_class, $field_1, $field_2)
    {

        // dump($terms->pluck('wp_taxonomy_id')->toArray());

        // Fetch association Records
        $related_records = DB::connection($this->wp_connection)->table('wp_term_relationships')
        ->whereIn('object_id', $objects->pluck('wp_id')->toArray())
        ->whereIn('term_taxonomy_id', $terms->pluck('wp_taxonomy_id')->toArray())

        ->get();

        //  $related_records = DB::connection($this->wp_connection)->table('wp_term_relationships')
        //  ->select('wp_term_relationships.object_id','wp_term_relationships.term_taxonomy_id')
        // ->join('wp_posts ', 'wp_posts.post_id','=','wp_term_relationships.object_id')
        // ->join('wp_term_taxonomy ', 'wp_term_taxonomy.term_taxonomy_id','=','wp_term_relationships.term_taxonomy_id')
        // ->where('wp_term_taxonomy.taxonomy','LIKE','hotel_facilities')
        // ->where('wp_posts.post_type','LIKE','st_hotel')

        // ->get();
        // dd($related_records->count());


        $final_list  = [];
        $objectMapper = $objects->pluck('id', 'wp_id')->toArray();
        $termMapper = $terms->pluck('id', 'wp_taxonomy_id')->toArray();

        foreach ($related_records as $record) {
            if (isset($objectMapper[$record->object_id]) && isset($termMapper[$record->term_taxonomy_id])) {
                $this->info("Append " . $field_2);
                $final_row = [

                    // Need to dynamically tour_id, type_id column
                    $field_1  => $objectMapper[$record->object_id],
                    $field_2  => $termMapper[$record->term_taxonomy_id]
                ];

                $final_list[] = $final_row;
            }
        }

        if (!empty($final_list)) {
            $term_rel_class::insert($final_list);
        }
    }


    public function associate_language_table($objects, $languages, $language_rel_class)
    {

        // dump($languages->pluck('wp_taxonomy_id')->toArray());

        // Fetch association Records
        $related_records = DB::connection($this->wp_connection)->table('wp_term_relationships')
        ->whereIn('object_id', $objects->pluck('wp_id')->toArray())
        ->whereIn('term_taxonomy_id', $languages->pluck('wp_taxonomy_id')->toArray())

        ->get();


        $final_list  = [];
        $objectMapper = $objects->pluck('id', 'wp_id')->toArray();
        $languageMapper = $languages->pluck('id', 'wp_taxonomy_id')->toArray();

        foreach ($related_records as $record) {
            if (isset($objectMapper[$record->object_id]) && isset($languageMapper[$record->term_taxonomy_id])) {
                $this->info("Append");
                $final_row = [

                    // Need to dynamically tour_id, type_id column
                    'tour_id' => $objectMapper[$record->object_id],
                    'language_id' => $languageMapper[$record->term_taxonomy_id]
                ];

                $final_list[] = $final_row;
            }
        }

        if (!empty($final_list)) {
            $language_rel_class::insert($final_list);
        }
    }

    public function associate_package_type_table($objects, $package_types, $package_type_rel_class)
    {


        // dump($types->pluck('wp_taxonomy_id')->toArray());

        // Fetch association Records

        $related_records = DB::connection($this->wp_connection)->table('wp_term_relationships')
        ->whereIn('object_id', $objects->pluck('wp_id')->toArray())
        ->whereIn('term_taxonomy_id', $package_types->pluck('wp_taxonomy_id')->toArray())

        ->get();


        $final_list  = [];
        $objectMapper = $objects->pluck('id', 'wp_id')->toArray();
        $package_typeMapper = $package_types->pluck('id', 'wp_taxonomy_id')->toArray();


        foreach ($related_records as $record) {
            if (isset($objectMapper[$record->object_id]) && isset($package_typeMapper[$record->term_taxonomy_id])) {
                $this->info("Append");
                $final_row = [

                    // Need to dynamically tour_id, type_id column
                    'tour_id' => $objectMapper[$record->object_id],
                    'package_type_id' => $package_typeMapper[$record->term_taxonomy_id]
                ];


                $final_list[] = $final_row;
            }
        }

        if (!empty($final_list)) {
            $package_type_rel_class::insert($final_list);
        }
    }
    public function associate_type_table($objects, $types, $type_rel_class)
    {

        // dump($types->pluck('wp_taxonomy_id')->toArray());

        // Fetch association Records
        $related_records = DB::connection($this->wp_connection)->table('wp_term_relationships')
        ->whereIn('object_id', $objects->pluck('wp_id')->toArray())
        ->whereIn('term_taxonomy_id', $types->pluck('wp_taxonomy_id')->toArray())
        ->get();


        $final_list  = [];
        $objectMapper = $objects->pluck('id', 'wp_id')->toArray();
        $typeMapper = $types->pluck('id', 'wp_taxonomy_id')->toArray();

        foreach ($related_records as $record) {
            if (isset($objectMapper[$record->object_id]) && isset($typeMapper[$record->term_taxonomy_id])) {
                $this->info("Append");
                $final_row = [
                    // Need to dynamically tour_id, type_id column
                    'tour_id' => $objectMapper[$record->object_id],
                    'type_id' => $typeMapper[$record->term_taxonomy_id]
                ];

                $final_list[] = $final_row;
            }
        }

        if (!empty($final_list)) {
            $type_rel_class::insert($final_list);
        }
    }

    public function setup_other_packages()
    {
        $this->info("Terms Other Package Data Loading...");

        foreach ($this->tour_other_package as $type => $term_values) {
            $other_package_list = collect([]);

            $results = DB::connection($this->wp_connection)->table('wp_terms as wt')
            ->select('wt.*', 'wtt.*', 'wtm.meta_key', 'wtm.meta_value')

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
            if (!empty($nestedResults)) {
                foreach ($nestedResults as $termId => $n_result) {
                    $tax_met_value = 'tax_meta_' . $n_result['term_taxonomy_id'];
                    $extra_data = [
                        "important_note" => $this->get_key_data($n_result["termmeta"], "important_note")
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
                        "extra_data" => json_encode($extra_data),
                        "wp_taxonomy_id" => $n_result['term_taxonomy_id']

                    ];

                    $other_package_list->push($single_package_type);
                }





                OtherPackage::insert($other_package_list->toArray());
            }
        }

        $this->info("Terms Other Package Data Loading Completed");
    }

    public function associate_other_package_table($objects, $other_packages, $other_package_rel_class)
    {

        // dump($types->pluck('wp_taxonomy_id')->toArray());

        // Fetch association Records
        $related_records = DB::connection($this->wp_connection)->table('wp_term_relationships')

        ->whereIn('object_id', $objects->pluck('wp_id')->toArray())
        ->whereIn('term_taxonomy_id', $other_packages->pluck('wp_taxonomy_id')->toArray())
        ->get();



        $final_list  = [];
        $objectMapper = $objects->pluck('id', 'wp_id')->toArray();
        $other_packageMapper = $other_packages->pluck('id', 'wp_taxonomy_id')->toArray();

        foreach ($related_records as $record) {
            if (isset($objectMapper[$record->object_id]) && isset($other_packageMapper[$record->term_taxonomy_id])) {
                $this->info("Append");
                $final_row = [
                    // Need to dynamically tour_id, type_id column
                    'tour_id' => $objectMapper[$record->object_id],
                    'other_package_id' => $other_packageMapper[$record->term_taxonomy_id]
                ];

                $final_list[] = $final_row;
            }
        }

        if (!empty($final_list)) {
            $other_package_rel_class::insert($final_list);
        }
    }

    public function associate_term_parent_id($term_class, $type='', $post_type='')
    {

        $this->info("Terms Parent Updating......");
        if (!empty($type) && !empty($post_type)) {
          $terms_parent = $term_class::where($type, $post_type)
          ->where('parent_id', '!=', 0)->get();
          $terms = $term_class::where($type, $post_type)->get();
      }else{
          $terms_parent = $term_class::where('parent_id', '!=', 0)->get();
          $terms = $term_class::get();

      }
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



public function setup_states()
{
    $this->info("Terms State Data Loading...");

    $state_list = collect([]);

    $results = DB::connection($this->wp_connection)->table('wp_terms as wt')
    ->select('wt.*', 'wtt.*', 'wtm.meta_key', 'wtm.meta_value')

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
        if (!empty($nestedResults)) {
            foreach ($nestedResults as $termId => $n_result) {
                $tax_met_value = 'tax_meta_' . $n_result['term_taxonomy_id'];
                $extra_data = [
                    "important_note" => $this->get_key_data($n_result["termmeta"], "activity_important_notes"),
                    "helpful_facts" => $this->get_key_data($n_result["termmeta"], "helpful_facts"),
                    "sanstive_data" => $this->get_key_data($n_result["termmeta"], "sanstive_data")
                ];

                $single_package_type = [
                    "name" => $n_result['name'],
                    "slug" => $n_result['slug'],
                    "parent_id" => $n_result['parent'], // We will set it
                    "description" => $n_result['description'],
                    "country" => $this->wp_term_country_refind($this->get_key_data($n_result["termmeta"], "country")),
                    "wp_term_id" => $termId,
                    "icon" => $this->wp_term_icon_refind($this->wp_option_get_value($tax_met_value)),
                    "extra_data" => json_encode($extra_data),
                    "wp_taxonomy_id" => $n_result['term_taxonomy_id']

                ];

                $state_list->push($single_package_type);
            }





            State::insert($state_list->toArray());
        }
    }

    public function associate_states_table($objects, $states, $state_rel_class, $field)
    {


        // dump($types->pluck('wp_taxonomy_id')->toArray());

        // Fetch association Records

        $related_records = DB::connection($this->wp_connection)->table('wp_term_relationships')

        ->whereIn('object_id', $objects->pluck('wp_id')->toArray())
        ->whereIn('term_taxonomy_id', $states->pluck('wp_taxonomy_id')->toArray())
        ->get();


        $final_list  = [];
        $objectMapper = $objects->pluck('id', 'wp_id')->toArray();
        $stateMapper = $states->pluck('id', 'wp_taxonomy_id')->toArray();


        foreach ($related_records as $record) {
            if (isset($objectMapper[$record->object_id]) && isset($stateMapper[$record->term_taxonomy_id])) {
                $this->info("Append ass");
                $final_row = [

                    // Need to dynamically tour_id, type_id column
                    $field => $objectMapper[$record->object_id],
                    'state_id' => $stateMapper[$record->term_taxonomy_id]
                ];

                $final_list[] = $final_row;
            }
        }

        if (!empty($final_list)) {
            $state_rel_class::insert($final_list);
        }
    }


    public function chnage_content($posts, $post_type)
    {
        if (!empty($posts)) {
            $this->info("Content Changing......");
            $posts->each(function ($item) use ($post_type) {
                $content = $this->get_content_from_wp($item->wp_id, $post_type);
                $item->description = $content;
                $item->update();
            });
            $this->info("Content Changed");
        } else {

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

    public function associate_hotel_location_table($objects, $locations, $location_rel_class)
    {

        // dump($types->pluck('wp_taxonomy_id')->toArray());

        // Fetch association Records
        $related_records = DB::connection($this->wp_connection)->table('wp_st_hotel')
        ->whereIn('post_id', $objects->pluck('wp_id')->toArray())->get();


        $final_list  = [];
        $objectMapper = $objects->pluck('id', 'wp_id')->toArray();
        $locationMapper = $locations->pluck('id', 'wp_id')->toArray();

        foreach ($related_records as $record) {
            if (isset($objectMapper[$record->post_id])) {
                $this->info("Append");
                $get_locations = $this->get_multi_locations($record->multi_location);
                foreach ($get_locations as $key => $get_location) {
                    $final_row = [
                        // Need to dynamically tour_id, type_id column
                        'hotel_id' => $objectMapper[$record->post_id],
                        'location_id' => $locationMapper[$get_location]
                    ];

                    $final_list[] = $final_row;
                }
            }
        }

        if (!empty($final_list)) {
            $location_rel_class::insert($final_list);
        }
    }

    public function associate_tour_location_table($objects, $locations, $location_rel_class)
    {

        // dump($types->pluck('wp_taxonomy_id')->toArray());

        // Fetch association Records
        $related_records = DB::connection($this->wp_connection)->table('wp_st_tours')
        ->whereIn('post_id', $objects->pluck('wp_id')->toArray())->get();


        $final_list  = [];
        $objectMapper = $objects->pluck('id', 'wp_id')->toArray();
        $locationMapper = $locations->pluck('id', 'wp_id')->toArray();

        foreach ($related_records as $record) {
            if (isset($objectMapper[$record->post_id])) {
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

        if (!empty($final_list)) {
            $location_rel_class::insert($final_list);
        }
    }

    public function associate_activity_location_table($objects, $locations, $location_rel_class)
    {

        // dump($types->pluck('wp_taxonomy_id')->toArray());

        // Fetch association Records
        $related_records = DB::connection($this->wp_connection)->table('wp_st_tours')
        ->whereIn('post_id', $objects->pluck('wp_id')->toArray())->get();


        $final_list  = [];
        $objectMapper = $objects->pluck('id', 'wp_id')->toArray();
        $locationMapper = $locations->pluck('id', 'wp_id')->toArray();

        foreach ($related_records as $record) {
            if (isset($objectMapper[$record->post_id])) {
                $this->info("Append");
                $get_locations = $this->get_multi_locations($record->multi_location);
                foreach ($get_locations as $key => $get_location) {
                    $final_row = [
                        // Need to dynamically tour_id, type_id column
                        'actvity_id' => $objectMapper[$record->post_id],
                        'location_id' => $locationMapper[$get_location]
                    ];

                    $final_list[] = $final_row;
                }
            }
        }

        if (!empty($final_list)) {
            $location_rel_class::insert($final_list);
        }
    }
    public function setup_room_facility()
    {
        $this->info("Terms facility Data Loading...");

        $room_facility_list = collect([]);
        $results = DB::connection($this->wp_connection)->table('wp_terms as wt')
        ->select('wt.*', 'wtt.*', 'wtm.meta_key', 'wtm.meta_value')

        ->join('wp_term_taxonomy as wtt', 'wt.term_id', '=', 'wtt.term_id')
        ->leftJoin('wp_termmeta as wtm', 'wt.term_id', '=', 'wtm.term_id')
        ->where('wtt.taxonomy', 'room_facilities')
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



        if (!empty($nestedResults)) {
            foreach ($nestedResults as $termId => $n_result) {
                $tax_met_value = 'tax_meta_' . $n_result['term_taxonomy_id'];
                $single_room_facility = [
                    "name" => $n_result['name'],
                    "slug" => $n_result['slug'],
                    "parent_id" => $n_result['parent'], // We will set it
                    "description" => $n_result['description'],
                    "facility_type" => 'Room',
                    "wp_term_id" => $termId,
                    "icon" => $this->wp_term_icon_refind($this->wp_option_get_value($tax_met_value)),
                    "wp_taxonomy_id" => $n_result['term_taxonomy_id']
                ];

                $room_facility_list->push($single_room_facility);
            }



            Facility::insert($room_facility_list->toArray());
        }



        $this->info("Terms facility Data Loading Completed");
    }

    public function setup_hotel_facility()
    {
        $this->info("Terms facility Data Loading...");

        $hotel_facility_list = collect([]);
        $results = DB::connection($this->wp_connection)->table('wp_terms as wt')
        ->select('wt.*', 'wtt.*', 'wtm.meta_key', 'wtm.meta_value')

        ->join('wp_term_taxonomy as wtt', 'wt.term_id', '=', 'wtt.term_id')
        ->leftJoin('wp_termmeta as wtm', 'wt.term_id', '=', 'wtm.term_id')
        ->where('wtt.taxonomy', 'hotel_facilities')
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



        if (!empty($nestedResults)) {
            foreach ($nestedResults as $termId => $n_result) {
                $tax_met_value = 'tax_meta_' . $n_result['term_taxonomy_id'];
                $single_hotel_facility = [
                    "name" => $n_result['name'],
                    "slug" => $n_result['slug'],
                    "parent_id" => $n_result['parent'], // We will set it
                    "description" => $n_result['description'],
                    "facility_type" => 'Hotel',
                    "wp_term_id" => $termId,
                    "icon" => $this->wp_term_icon_refind($this->wp_option_get_value($tax_met_value)),
                    "wp_taxonomy_id" => $n_result['term_taxonomy_id']
                ];

                $hotel_facility_list->push($single_hotel_facility);
            }



            Facility::insert($hotel_facility_list->toArray());
        }



        $this->info("Terms facility Data Loading Completed");
    }

    public function setup_hotel_amenity()
    {
        $this->info("Terms amenity Data Loading...");
        $hotel_amenity_list = collect([]);
        $results = DB::connection($this->wp_connection)->table('wp_terms as wt')
        ->select('wt.*', 'wtt.*', 'wtm.meta_key', 'wtm.meta_value')

        ->join('wp_term_taxonomy as wtt', 'wt.term_id', '=', 'wtt.term_id')
        ->leftJoin('wp_termmeta as wtm', 'wt.term_id', '=', 'wtm.term_id')
        ->where('wtt.taxonomy', 'amenities')
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



        if (!empty($nestedResults)) {
            foreach ($nestedResults as $termId => $n_result) {
                $tax_met_value = 'tax_meta_' . $n_result['term_taxonomy_id'];
                $single_amenity_facility = [
                    "name" => $n_result['name'],
                    "slug" => $n_result['slug'],
                    "parent_id" => $n_result['parent'], // We will set it
                    "description" => $n_result['description'],
                    "amenity_type" => 'Hotel',
                    "wp_term_id" => $termId,
                    "icon" => $this->wp_term_icon_refind($this->wp_option_get_value($tax_met_value)),
                    "wp_taxonomy_id" => $n_result['term_taxonomy_id']
                ];

                $hotel_amenity_list->push($single_amenity_facility);
            }



            Amenity::insert($hotel_amenity_list->toArray());
        }



        $this->info("Terms amenity Data Loading Completed");
    }
    public function setup_hotel_medicare_assistance()
    {
        $this->info("Terms medicare_assistance Data Loading...");
        $hotel_medicare_assistance_list = collect([]);
        $results = DB::connection($this->wp_connection)->table('wp_terms as wt')
        ->select('wt.*', 'wtt.*', 'wtm.meta_key', 'wtm.meta_value')

        ->join('wp_term_taxonomy as wtt', 'wt.term_id', '=', 'wtt.term_id')
        ->leftJoin('wp_termmeta as wtm', 'wt.term_id', '=', 'wtm.term_id')
        ->where('wtt.taxonomy', 'medicare-assistance')
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



        if (!empty($nestedResults)) {
            foreach ($nestedResults as $termId => $n_result) {
                $tax_met_value = 'tax_meta_' . $n_result['term_taxonomy_id'];
                $single_hotel_medicare_assistance = [
                    "name" => $n_result['name'],
                    "slug" => $n_result['slug'],
                    "parent_id" => $n_result['parent'], // We will set it
                    "description" => $n_result['description'],
                    "medicare_assistance_type" => 'Hotel',
                    "wp_term_id" => $termId,
                    "icon" => $this->wp_term_icon_refind($this->wp_option_get_value($tax_met_value)),
                    "wp_taxonomy_id" => $n_result['term_taxonomy_id']
                ];

                $hotel_medicare_assistance_list->push($single_hotel_medicare_assistance);
            }
            MedicareAssistance::insert($hotel_medicare_assistance_list->toArray());
        }
        $this->info("Terms medicare_assistance Data Loading Completed");
    }
    public function setup_hotel_top_service()
    {
        $this->info("Terms top_service Data Loading...");
        $hotel_top_service_list = collect([]);
        $results = DB::connection($this->wp_connection)->table('wp_terms as wt')
        ->select('wt.*', 'wtt.*', 'wtm.meta_key', 'wtm.meta_value')

        ->join('wp_term_taxonomy as wtt', 'wt.term_id', '=', 'wtt.term_id')
        ->leftJoin('wp_termmeta as wtm', 'wt.term_id', '=', 'wtm.term_id')
        ->where('wtt.taxonomy', 'hotel-top-services')
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



        if (!empty($nestedResults)) {
            foreach ($nestedResults as $termId => $n_result) {
                $tax_met_value = 'tax_meta_' . $n_result['term_taxonomy_id'];
                $single_top_service = [
                    "name" => $n_result['name'],
                    "slug" => $n_result['slug'],
                    "parent_id" => $n_result['parent'], // We will set it
                    "description" => $n_result['description'],
                    "top_service_type" => 'Hotel',
                    "wp_term_id" => $termId,
                    "icon" => $this->wp_term_icon_refind($this->wp_option_get_value($tax_met_value)),
                    "wp_taxonomy_id" => $n_result['term_taxonomy_id']
                ];

                $hotel_top_service_list->push($single_top_service);
            }
            TopService::insert($hotel_top_service_list->toArray());
        }
        $this->info("Terms top_service Data Loading Completed");
    }



    public function setup_hotel_accessible_type()
    {
        $this->info("Terms accessible_type Data Loading...");
        $hotel_accessible_type_list = collect([]);
        $results = DB::connection($this->wp_connection)->table('wp_terms as wt')
        ->select('wt.*', 'wtt.*', 'wtm.meta_key', 'wtm.meta_value')

        ->join('wp_term_taxonomy as wtt', 'wt.term_id', '=', 'wtt.term_id')
        ->leftJoin('wp_termmeta as wtm', 'wt.term_id', '=', 'wtm.term_id')
        ->where('wtt.taxonomy', 'accessible')
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



        if (!empty($nestedResults)) {
            foreach ($nestedResults as $termId => $n_result) {
                $tax_met_value = 'tax_meta_' . $n_result['term_taxonomy_id'];
                $single_accessible_type = [
                    "name" => $n_result['name'],
                    "slug" => $n_result['slug'],
                    "parent_id" => $n_result['parent'], // We will set it
                    "description" => $n_result['description'],
                    "accessible_type" => 'Hotel',
                    "wp_term_id" => $termId,
                    "icon" => $this->wp_term_icon_refind($this->wp_option_get_value($tax_met_value)),
                    "wp_taxonomy_id" => $n_result['term_taxonomy_id']
                ];

                $hotel_accessible_type_list->push($single_accessible_type);
            }
            Accessible::insert($hotel_accessible_type_list->toArray());
        }
        $this->info("Terms accessible_type Data Loading Completed");
    }

    public function setup_hotel_occupancy()
    {
        $this->info("Terms occupancy Data Loading...");
        $hotel_occupancy_list = collect([]);
        $results = DB::connection($this->wp_connection)->table('wp_terms as wt')
        ->select('wt.*', 'wtt.*', 'wtm.meta_key', 'wtm.meta_value')

        ->join('wp_term_taxonomy as wtt', 'wt.term_id', '=', 'wtt.term_id')
        ->leftJoin('wp_termmeta as wtm', 'wt.term_id', '=', 'wtm.term_id')
        ->where('wtt.taxonomy', 'occupancy')
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
        if (!empty($nestedResults)) {
            foreach ($nestedResults as $termId => $n_result) {
                $tax_met_value = 'tax_meta_' . $n_result['term_taxonomy_id'];
                $single_occupancy = [
                    "name" => $n_result['name'],
                    "slug" => $n_result['slug'],
                    "parent_id" => $n_result['parent'], // We will set it
                    "description" => $n_result['description'],
                    "occupancy_type" => 'Hotel',
                    "wp_term_id" => $termId,
                    "icon" => $this->wp_term_icon_refind($this->wp_option_get_value($tax_met_value)),
                    "wp_taxonomy_id" => $n_result['term_taxonomy_id']
                ];

                $hotel_occupancy_list->push($single_occupancy);
            }
            Occupancy::insert($hotel_occupancy_list->toArray());
        }
        $this->info("Terms occupancy Data Loading Completed");
    }

    public function setup_hotel_deals_discount_type()
    {
        $this->info("Terms deals_discount_type Data Loading...");
        $hotel_deals_discount_type_list = collect([]);
        $results = DB::connection($this->wp_connection)->table('wp_terms as wt')
        ->select('wt.*', 'wtt.*', 'wtm.meta_key', 'wtm.meta_value')

        ->join('wp_term_taxonomy as wtt', 'wt.term_id', '=', 'wtt.term_id')
        ->leftJoin('wp_termmeta as wtm', 'wt.term_id', '=', 'wtm.term_id')
        ->where('wtt.taxonomy', 'deals-discount')
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



        if (!empty($nestedResults)) {
            foreach ($nestedResults as $termId => $n_result) {
                $tax_met_value = 'tax_meta_' . $n_result['term_taxonomy_id'];
                $single_deals_discount_type = [
                    "name" => $n_result['name'],
                    "slug" => $n_result['slug'],
                    "parent_id" => $n_result['parent'], // We will set it
                    "description" => $n_result['description'],
                    "deals_discount_type" => 'Hotel',
                    "wp_term_id" => $termId,
                    "icon" => $this->wp_term_icon_refind($this->wp_option_get_value($tax_met_value)),
                    "wp_taxonomy_id" => $n_result['term_taxonomy_id']
                ];

                $hotel_deals_discount_type_list->push($single_deals_discount_type);
            }
            DealsDiscount::insert($hotel_deals_discount_type_list->toArray());
        }
        $this->info("Terms deals_discount_type Data Loading Completed");
    }

    public function setup_hotel_activities()
    {
        $this->info("Terms activities Data Loading...");
        $hotel_activities_list = collect([]);
        $results = DB::connection($this->wp_connection)->table('wp_terms as wt')
        ->select('wt.*', 'wtt.*', 'wtm.meta_key', 'wtm.meta_value')

        ->join('wp_term_taxonomy as wtt', 'wt.term_id', '=', 'wtt.term_id')
        ->leftJoin('wp_termmeta as wtm', 'wt.term_id', '=', 'wtm.term_id')
        ->where('wtt.taxonomy', 'activities')
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



        if (!empty($nestedResults)) {
            foreach ($nestedResults as $termId => $n_result) {
                $tax_met_value = 'tax_meta_' . $n_result['term_taxonomy_id'];
                $single_activities = [
                    "name" => $n_result['name'],
                    "slug" => $n_result['slug'],
                    "parent_id" => $n_result['parent'], // We will set it
                    "description" => $n_result['description'],
                    "term_activity_type" => 'Hotel',
                    "wp_term_id" => $termId,
                    "icon" => $this->wp_term_icon_refind($this->wp_option_get_value($tax_met_value)),
                    "wp_taxonomy_id" => $n_result['term_taxonomy_id']
                ];

                $hotel_activities_list->push($single_activities);
            }
            TermActivity::insert($hotel_activities_list->toArray());
        }
        $this->info("Terms activities Data Loading Completed");
    }

    public function setup_hotel_property_type_type()
    {
        $this->info("Terms property_type_type Data Loading...");
        $hotel_property_type_type_list = collect([]);
        $results = DB::connection($this->wp_connection)->table('wp_terms as wt')
        ->select('wt.*', 'wtt.*', 'wtm.meta_key', 'wtm.meta_value')

        ->join('wp_term_taxonomy as wtt', 'wt.term_id', '=', 'wtt.term_id')
        ->leftJoin('wp_termmeta as wtm', 'wt.term_id', '=', 'wtm.term_id')
        ->where('wtt.taxonomy', 'property-type')
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



        if (!empty($nestedResults)) {
            foreach ($nestedResults as $termId => $n_result) {
                $tax_met_value = 'tax_meta_' . $n_result['term_taxonomy_id'];
                $extra_data = [
                    "important_note" => $this->get_key_data($n_result["termmeta"], "important_note")
                ];
                $single_property_type_type = [
                    "name" => $n_result['name'],
                    "slug" => $n_result['slug'],
                    "parent_id" => $n_result['parent'], // We will set it
                    "description" => $n_result['description'],
                    "property_type_type" => 'Hotel',
                    "wp_term_id" => $termId,
                    "extra_data" => json_encode($extra_data),
                    "icon" => $this->wp_term_icon_refind($this->wp_option_get_value($tax_met_value)),
                    "wp_taxonomy_id" => $n_result['term_taxonomy_id']
                ];

                $hotel_property_type_type_list->push($single_property_type_type);
            }
            PropertyType::insert($hotel_property_type_type_list->toArray());
        }
        $this->info("Terms property_type_type Data Loading Completed");
    }

    public function setup_meeting_and_event_types()
    {
        $this->info("Terms meeting and event Data Loading...");

        $meeting_and_event_type_list = collect([]);

        $results = DB::connection($this->wp_connection)->table('wp_terms as wt')
        ->select('wt.*', 'wtt.*', 'wtm.meta_key', 'wtm.meta_value')

        ->join('wp_term_taxonomy as wtt', 'wt.term_id', '=', 'wtt.term_id')
        ->leftJoin('wp_termmeta as wtm', 'wt.term_id', '=', 'wtm.term_id')
        ->where('wtt.taxonomy', 'meetings-and-events')
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
        if (!empty($nestedResults)) {
            foreach ($nestedResults as $termId => $n_result) {
                $tax_met_value = 'tax_meta_' . $n_result['term_taxonomy_id'];
                $extra_data = [
                    "important_note" => $this->get_key_data($n_result["termmeta"], "important_note")
                ];
                $single_meeting_and_event_type = [
                    "name" => $n_result['name'],
                    "slug" => $n_result['slug'],

                    "parent_id" => $n_result['parent'], // We will set it
                    "description" => $n_result['description'],
                    "meeting_and_event_type" => 'Hotel',
                    "wp_term_id" => $termId,
                    "icon" => $this->wp_term_icon_refind($this->wp_option_get_value($tax_met_value)),
                    "extra_data" => json_encode($extra_data),
                    "wp_taxonomy_id" => $n_result['term_taxonomy_id']

                ];

                $meeting_and_event_type_list->push($single_meeting_and_event_type);
            }

            MeetingAndEvent::insert($meeting_and_event_type_list->toArray());
        }


        $this->info("Terms meet and event Data Loading Completed");
    }

    public function get_postmeta_field_value($id,$field)
    {
        $get_value = DB::connection($this->wp_connection)->table('wp_postmeta')
        ->where('meta_key','=',$field)->where('post_id',$id)->first();
        if (!empty($get_value)) {
         return $get_value->meta_value;
     }else{
        return null;
    }
}

public function check_in_and_check_out_change_in_hotel()
{
    $this->info("Start Update.....");

    $hotels = Hotel::get(['id','check_in','check_out','wp_id']);

    $hotels->each(function($item){

        $item->check_in = $this->get_postmeta_field_value($item->wp_id,'check_in_time');
        $item->check_out = $this->get_postmeta_field_value($item->wp_id,'check_out_time');
        $item->update();

    });
    $this->info("Updated Data");
}

public function get_post_id_from_laravel($post_id,$posts,$col)
{
   $result = 0;
   $get_post = $posts->where($col,$post_id)->first();

   if (!empty( $get_post)) {
      $result = $get_post->id;
  }
  return $result;
}

public function comman_post_relationship_fun($objects,$custom_posts,$custom_post_class,string $meta_key,string $field1,string $field2,string $field3)
{

    $this->info("Post relationship.....");
    $postmeta = DB::connection($this->wp_connection)->table('wp_postmeta')
    ->where('meta_key','like',$meta_key)->get();
    $push_data = collect([]);
    $postmeta->each(function($item)use ($field1,$field2,$field3,$objects,$custom_posts,&$push_data){

      $post_m_id = $this->get_post_id_from_laravel((int)$item->meta_value,$objects,$field3);
      $post_r_id = $this->get_post_id_from_laravel($item->post_id,$custom_posts,$field3);
      if ($post_m_id != 0) {
       $custom_set_post = [
        $field1 => $post_m_id, 
        $field2 => $post_r_id
    ];
    $push_data->push($custom_set_post);
}



});

    $custom_post_class::insert($push_data->toArray());
    $this->info("Done.....");
}

public function update_page_extra_data($id,$data)
{
    $page = Page::find($id);

    if (!empty($page)) {

   $extra_data["hotel_commen_amenities"] = $data['hotel_commen_amenities'];
   $extra_data["hotel_common_property_type"] = null; 
   $extra_data["hotel_common_medicare_assistance"] = $data['hotel_common_medicare_assistance']; 
   $extra_data["hotel_common_meetings_and_events"] = $data['hotel_common_meetings_and_events']; 
   $extra_data["hotel_common_deals_discount"] = $data['hotel_common_deals_discount'];
   $extra_data["hotel_common_activities"] = $data['hotel_common_activities'];
     $page->extra_data = $extra_data;
        $page->update();
    }
    $this->info("Done");

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
        if ($isFresh == "clean") {

            //  $tables = ['hotels', 'hotel_details'];
           //  $tables = ['tours','tour_details'];
            // $tables = ['tours','tour_details','users','files','media'];
            //$term_table = ['types','tour_types'];

            // $tables = ['users','tours','locations','location_meta','country_zones'];
            // $tables = ['locations','location_meta'];
            // $tables = ['location_meta'];

          //   $tables = ['posts'];

             $tables = ['hotel_states'];


            //$tables = ['tour_locations'];
       //      $tables = ['languages','tour_languages','tour_locations','package_types','tour_package_types','other_packages','tour_other_packages','types','tour_types','tour_states'];
            // $term_table = ['room_facilities'];
            // $term_table = ['activity_languages','activity_states'];
            // $term_table = ['attractions','term_activity_lists','activity_attractions','activity_term_activity_lists'];

            // $tables = ['hotel_places','hotel_states','hotel_locations'];
         //   $tables = ['activity_languages','activity_states','activity_locations','activity_attractions','activity_term_activity_lists'];
     //    $tables = ['activity_lists_activities','activity_package_activities','activity_activity_zones'];
           // $tables = ['hotel_locations'];
           // $tables = [
           //  'hotel_places',
           //  'hotel_states',
           //  'hotel_locations',
           //  "hotel_accessibles",
           //  "hotel_amenities",
           //  "hotel_deals",
           //  "hotel_facilities",
           //  "hotel_medicare_assistances",
           //  "hotel_meeting_events",
           //  "hotel_occupancies",
           //  "hotel_property_types",
           //  "hotel_top_services",
           //  "hotel_activities",
           //  "accessibles",
           //  "amenities",
           //  "deals_discounts",
           //  "facilities",
           //  "medicare_assistances",
           //  "meeting_and_events",
           //  "occupancies",
           //  "property_types",
           //  'places',
           //  'states',
           //  "term_activities",
           //  "top_services"];
            //$term_table = ['package_types','tour_package_types'];
            //  $term_table = ['other_packages','tour_other_packages'];
            // $term_table = ['states','tour_states'];
        //    $term_table = ['hotel_places'];
            // $term_table = ['places','location_places'];
            //$term_table = ['location_states'];
            //$term_table = ['hotel_states'];
            //$term_table = ['activity_states'];

            //$tables = ['posts'];
            //$tables = ['country_zones'];

             //$tables = ['activities'];
            // $tables = ['tourism_zones'];
            //$tables = ['rooms','room_details','hotels','hotel_details'];


            $this->info("Truncating tables...");
           //$this->truncate_tables($term_table);

          $this->truncate_tables($tables);



            $this->info("Table Truncated...");
        }

       // $this->update_tour_migrate();

        // File Module
        //    $this->file_migrate();
        // Media Module
        //    $this->media_migrate();


        // File Module
        //$this->file_migrate();
        // Media Module
        //  $this->media_migrate();

        // User Module

        //   $this->user_migrate();


        // Tour Module
        //    $this->tour_migrate();

        // $this->load_tour_details();
        // Location Module

        //  $this->location_migrate();

        // Location Meta Module
        //    $this->location_meta_migrate();

        // $this->st_country_zones_migration();

        // Hotel Module

        // $this->hotel_migrate();
        // $this->load_hotel_details();
        // $this->room_migrate();
        // $this->load_room_details();

        // $this->activity_migrate();
         //$this->load_activity_details();

        // Setup Types

       // $this->post_migrate();

//$this->setup_types();
     //   $this->setup_package_types();
       // $this->setup_other_packages();
       //  $this->setup_language();
        // $this->setup_states();
        // $this->setup_places();
        // Associate with Types
        // For Tour
        // $this->setup_hotel_facility();
        // $this->setup_hotel_amenity();
        // $this->setup_hotel_medicare_assistance();
        // $this->setup_hotel_top_service();
        // $this->setup_hotel_accessible_type();
        // $this->setup_hotel_occupancy();
        // $this->setup_hotel_deals_discount_type();
        // $this->setup_hotel_activities();
        // $this->setup_hotel_property_type_type();
        // $this->setup_meeting_and_event_types();
     //   $tours = Tour::get();
      //  $hotels = Hotel::get();
        //$activities = Activity::get();
        // $tours = Tour::where('description','like','%[vc_row]%')->get();

     //  $types = Type::where('type', 'Tour')->get();

      //  $languages = Language::get();
        $hotels = Hotel::get();

        // $this->st_tourism_zones_migration();
       //   $this->st_activity_package_migration();
       //  $this->st_activity_lists_migration();
       // // $this->st_activity_zones_migration();

       // $st_activity_lists = ActivityLists::get();
       // $st_activity_package = ActivityPackage::get();
       // $st_activity_zone = ActivityZone::get();

        // $this->comman_post_relationship_fun($activities,$st_activity_lists,ActivityListsActivity::class,'activity_id_for_activity_list','activity_id','activity_list_id','wp_id');
        // $this->comman_post_relationship_fun($activities,$st_activity_package,ActivityPackageActivity::class,'activity_id_for_activity_package','activity_id','activity_package_id','wp_id');
        //  $this->comman_post_relationship_fun($st_activity_zone,$activities,ActivityActivityZone::class,'st_activity_zones_id','activity_zone_id','activity_id','wp_id');
        // $this->comman_post_relationship_fun();

        // $facilities = Facility::where('facility_type','Hotel');
        // $this->associate_comman_relationship_table($hotels, $facilities, HotelFacility::class,'hotel_id','facility_id');
        // $amenities = Amenity::where('amenity_type','Hotel');
        // $this->associate_comman_relationship_table($hotels, $amenities, HotelAmenities::class,'hotel_id','amenity_id');
        // $medicare_a = MedicareAssistance::where('medicare_assistance_type','Hotel');
        // $this->associate_comman_relationship_table($hotels, $medicare_a, HotelMedicareAssistance::class,'hotel_id','medicare_assistance_id');
        // $top_services = TopService::where('top_service_type','Hotel');
        // $this->associate_comman_relationship_table($hotels, $top_services, HotelTopService::class,'hotel_id','top_service_id');
        // $accessibles = Accessible::where('accessible_type','Hotel');
        // $this->associate_comman_relationship_table($hotels, $accessibles, HotelAccessible::class,'hotel_id','accessible_id');
        // $occupances = Occupancy::where('occupancy_type','Hotel');
        // $this->associate_comman_relationship_table($hotels, $occupances, HotelOccupancy::class,'hotel_id','occupancies_id');
        // $deals_discouts = DealsDiscount::where('deals_discount_type','Hotel');
        // $this->associate_comman_relationship_table($hotels, $deals_discouts, HotelDeal::class,'hotel_id','deal_id');
        // $term_activities = TermActivity::where('term_activity_type','Hotel');
        // $this->associate_comman_relationship_table($hotels, $term_activities, HotelActivity::class,'hotel_id','activity_id');
        // $property_types = PropertyType::where('property_type_type','Hotel');
        // $this->associate_comman_relationship_table($hotels, $property_types, HotelPropertyType::class,'hotel_id','property_type_id');
        // $meeting_and_events = MeetingAndEvent::where('meeting_and_event_type','Hotel');
        // $this->associate_comman_relationship_table($hotels, $meeting_and_events, HotelMeetingEvent::class,'hotel_id','meeting_id');



         $states = State::get();
        // $this->associate_states_table($hotels, $states, HotelState::class,'hotel_id');
        // $places = Place::get();

      // $locations = Location::get();
        //$this->associate_states_table($locations, $states, LocationState::class,'location_id');
       // $this->associate_states_table($activities, $states, ActivityState::class,'activity_id');
      $this->associate_states_table($hotels, $states, HotelState::class,'hotel_id');
      //  $this->associate_language_table($tours, $languages, TourLanguage::class);

       // $this->associate_hotel_location_table($hotels, $locations, HotelLocation::class );
     //  $this->associate_tour_location_table($tours, $locations, TourLocation::class );

     //   $this->associate_type_table($tours, $types, TourType::class);
        // $this->setup_room_facility();
         //$this->setup_attractions();
        // $this->setup_term_activity_lists();
          // $activities = Activity::get();
          //$attractions_list = Attraction::get();
          //$term_activity_lists = TermActivityList::get();
         // $rooms = Room::get();
         //$types = Type::where('type','Room')->get();
         //$facilities = Facility::where('facility_type','Room')->get();
         // $this->associate_comman_relationship_table($activities, $attractions_list, ActivityAttraction::class,'activity_id','attraction_id');
         // $this->associate_comman_relationship_table($activities, $term_activity_lists, ActivityTermActivityList::class,'activity_id','term_activity_lists_id');

        // Associate with Types
        // For Tour

         // $tours = Tour::get();
         //$package_types = PackageType::where('package_type_type', 'Tour')->get();
      //  $places = Place::get();
        // $this->associate_comman_relationship_table($activities, $languages, ActivityLanguage::class,'activity_id','language_id');
        // $this->associate_comman_relationship_table($activities, $states, ActivityState::class,'activity_id','state_id');
        // $this->associate_activity_location_table($activities, $locations, ActivityLocation::class );
    // $this->associate_comman_relationship_table($hotels, $locations, HotelPlace::class,'hotel_id','place_id');
      //  $this->associate_comman_relationship_table($hotels, $places, HotelPlace::class,'hotel_id','place_id');
        //$this->associate_comman_relationship_table($locations, $places, LocationPlace::class,'location_id','place_id');
        // $this->associate_comman_relationship_table($tours, $package_types, TourPackageType::class,'tour_id','package_type_id');
        //  $this->associate_package_type_table($tours, $package_types, TourPackageType::class);
        //  $other_packages = OtherPackage::where('other_package_type', 'Tour')->get();
        // //$states = State::get();
        // $this->associate_other_package_table($tours, $other_packages, TourOtherPackage::class);


        //   //$this->chnage_content($tours,'st_tours');

     //  $this->associate_term_parent_id(OtherPackage::class);

       // $this->check_in_and_check_out_change_in_hotel();
        //         $temp = DB::connection($this->wp_connection)->table('wp_postmeta as wp')->select('wp.meta_value')->where('post_id',17559)->where('meta_key','like','save_your_pocket_pdf')->first();
        // dd($this->unserialize_data_format_in_array("$temp->meta_value","save_your_pocket_pdf"));


//     $amenities = Amenity::whereIn('wp_taxonomy_id',[2372,1077,2409,2415,2419,881,2427,2429,2408,874, 2437, 867, 2439, 2514, 857, 2449, 1074, 934, 2403, 1076, 1092, 856,2484])->get('id')->pluck('id')->toArray();
//    // $property_type = PropertyType::whereIn('wp_taxonomy_id',[])->get('id')->pluck('id')->toArray();

// $medicare_assistance = MedicareAssistance::whereIn('wp_taxonomy_id',[341,342,343])->get('id')->pluck('id')->toArray();
// $meetings_and_events = MeetingAndEvent::whereIn('wp_taxonomy_id',[476,475,2129])->get('id')->pluck('id')->toArray();
// $deals_discount = DealsDiscount::whereIn('wp_taxonomy_id',[473,472,2000,474,471])->get('id')->pluck('id')->toArray();
// $activities = TermActivity::whereIn('wp_taxonomy_id',[1794,2015, 1154, 1908, 462, 1581, 1055, 764, 457, 576, 2624, 751, 458, 1843,  757,  1083,  1575,  1286,  1821,  614,  1608,  758,  836,  999,  453,  1579,  769,  762])->get('id')->pluck('id')->toArray();
        
    //  $set_data['hotel_commen_amenities'] = $amenities;
    // // $set_data['hotel_common_property_type'] = 
    //  $set_data['hotel_common_medicare_assistance'] =$medicare_assistance; 
    //  $set_data['hotel_common_meetings_and_events'] = $meetings_and_events;
    //  $set_data['hotel_common_deals_discount'] =$deals_discount;
    //  $set_data['hotel_common_activities'] = $activities;

     

       // $this->update_page_extra_data(1,$set_data);


        return Command::SUCCESS;
    }
}