<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationMeta extends Model
{
    use HasFactory;
    protected $table = "location_meta";
    protected $guarded = [];
    protected $casts = [
        'location_content'=>'array',
        'child_tabs'=>'array',
        'place_to_visit'=>'array',
        'best_time_to_visit'=>'array',
        'how_to_reach'=>'array',
        'fair_and_festivals'=>'array',
        'culinary_retreat'=>'array',
        'shopaholics_anonymous'=>'array',
        'weather'=>'array',
        'location_map'=>'array',
        'what_to_do'=>'array',
        'get_to_know'=>'array',
        'save_your_pocket'=>'array',
        'save_your_environment'=>'array',
        'faqs'=>'array',
        'by_aggregators'=>'array',
        'b_govt_subsidiaries'=>'array',
        'by_hotels'=>'array',
        'gallery'=>'array',
        'location_video'=>'array',
        'hotel_activities'=>'array',
        'location_packages'=>'array',
        'location_for_filter'=>'array',
        'hotel_locations'=>'array',
        'fair_and_festivals_image' => 'array',
        'get_to_know_image'=> 'array',
        'save_your_pocket_image'=> 'array',
        'save_your_environment_image'=> 'array',
    ];
}


