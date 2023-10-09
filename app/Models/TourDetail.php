<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'gallery' => 'array',
        'contact' => 'array',
        'tour_sponsored_by' => 'array',
        'tours_destinations' => 'array',
        'tour_helpful_facts' => 'array',
        'tours_program' => 'array',
        'tours_program_bgr' => 'array',
        'tours_program_style4' => 'array',
        'tours_faq' => 'array',
        'package_route' => 'array',
        'calendar_starttime_hour' => 'array',
        'calendar_starttime_minute' => 'array',
        'calendar_starttime_format' => 'array',
        'social_links' => 'array',
        'properties_near_by' => 'array',
        'sponsored' => 'array',
        'enable_street_views_google_map' => 'boolean',
        'is_iframe' => 'boolean',
        'st_tour_external_booking' => 'boolean',
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
