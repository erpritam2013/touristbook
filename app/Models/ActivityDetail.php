<?php

namespace App\Models;
use App\Models\ActivityZone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityDetail extends Model
{
    use HasFactory;

     protected $guarded = [];

    protected $casts = [
        'gallery' => 'array',
        'contact' => 'array',
        'activity_program' => 'array',
        'activity_program_bgr' => 'array',
        'activity_faq' => 'array',
        'calendar_starttime_hour' => 'array',
        'calendar_starttime_minute' => 'array',
        'calendar_starttime_format' => 'array',
        'activity_zones' => 'array',
        'properties_near_by' => 'array',
        'social_links' => 'array',
        'enable_street_views_google_map' => 'boolean',
        'calendar_groupday' => 'boolean',
        'st_allow_cancel' => 'boolean',
        'is_meta_payment_gateway_st_submit_form' => 'boolean',
        'check_editing' => 'boolean',
        'latitude' => 'float',
        'longitude' => 'float',
        'calendar_adult_price' => 'float',
        'calendar_child_price' => 'float',
        'calendar_infant_price' => 'float',
    ];

   
}
