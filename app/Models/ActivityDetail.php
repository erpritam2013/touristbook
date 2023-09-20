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
        'activity_faq' => 'array',
        'calendar_starttime_hour' => 'array',
        'calendar_starttime_minute' => 'array',
        'calendar_starttime_format' => 'array',
        'activity_zones' => 'array',
        'properties_near_by' => 'array',
        'social_links' => 'array'
    ];

     public function activity_zone() {
        return $this->hasOne(ActivityZone::class);
    }
}
