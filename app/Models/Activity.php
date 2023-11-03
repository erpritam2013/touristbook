<?php

namespace App\Models;

use App\Models\location;
use App\Models\ActivityList;
use App\Models\ActivityLists;
use App\Models\ActivityDetail;
use App\Models\Terms\Attraction;
use App\Models\Terms\Language;
use App\Models\Terms\State;
use App\Models\Terms\TermActivityList;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Activity extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [];

    protected $casts = [
        'discount_by_child' => 'array',
        'discount_by_adult' => 'array',
        'extra_price' => 'array',
        'disable_children_name'=>'boolean',
        'hide_children_in_booking_form'=>'boolean',
        'hide_adult_in_booking_form'=>'boolean',
        'disable_infant_name'=>'boolean',
        'hide_infant_in_booking_form'=>'boolean',
        'st_activity_external_booking'=>'boolean',
        'is_sale_schedule'=>'boolean',
        'is_featured'=>'boolean',
        'price'=>'float',
        'sale_price'=>'float',
        'child_price'=>'float',
        'adult_price'=>'float',
        'infant_price'=>'float',
        'min_price'=>'float',
        'deposit_payment_amount'=>'float',
        'rating'=>'float',
        'featured_image' => 'array',
    ];

    public function sluggable(): Array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

     public function activity_zone() {
        return $this->belongsToMany(ActivityZone::class, 'activity_activity_zones', 'activity_id', 'activity_zone_id');
    }
     public function activity_packages() {
        return $this->belongsToMany(ActivityPackage::class, 'activity_package_activities', 'activity_id', 'activity_package_id');
    }

    public function attractions() {
        return $this->belongsToMany(Attraction::class, 'activity_attractions', 'activity_id', 'attraction_id');
    }


    public function locations() {
        return $this->belongsToMany(location::class, 'activity_locations', 'activity_id', 'location_id');
    }

    public function languages() {
        return $this->belongsToMany(Language::class, 'activity_languages', 'activity_id', 'language_id');
    }

    public function term_activity_lists() {
        return $this->belongsToMany(TermActivityList::class, 'activity_term_activity_lists', 'activity_id', 'term_activity_lists_id');
    }
    public function activity_lists() {
        return $this->belongsToMany(ActivityLists::class, 'activity_lists_activities', 'activity_id', 'activity_list_id');
    }
    public function states() {
        return $this->belongsToMany(State::class, 'activity_states', 'activity_id', 'state_id');
    }

    public function detail() {
        return $this->hasOne(ActivityDetail::class);
    }
}
