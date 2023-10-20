<?php

namespace App\Models;

use App\Models\Terms\Accessible;
use App\Models\Terms\Amenity;
use App\Models\Terms\DealsDiscount;
use App\Models\Terms\Facility;
use App\Models\Terms\MedicareAssistance;
use App\Models\Terms\MeetingAndEvent;
use App\Models\Terms\Occupancy;
use App\Models\Terms\Place;
use App\Models\Terms\PropertyType;
use App\Models\Terms\State;
use App\Models\Terms\TermActivity;
use App\Models\Terms\TopService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Hotel extends Model
{
    use HasFactory, Sluggable;

    const ACTIVE = 1;
    const INACTIVE = 0;

    protected $guarded = [];

    protected $casts = [
        'hotel_attributes' => 'array',
        'contact' => 'array',
        'policies' => 'array',
        'notices' => 'array',
        'images' => 'array'
    ];

    public function sluggable(): Array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    public function facilities() {
        return $this->belongsToMany(Facility::class, 'hotel_facilities', 'hotel_id', 'facility_id');
    }

    public function amenities() {
        return $this->belongsToMany(Amenity::class, 'hotel_amenities', 'hotel_id', 'amenity_id');
    }

    public function medicare_assistances() {
        return $this->belongsToMany(MedicareAssistance::class, 'hotel_medicare_assistances', 'hotel_id', 'medicare_assistance_id');
    }

    public function top_services() {
        return $this->belongsToMany(TopService::class, 'hotel_top_services', 'hotel_id', 'top_service_id');
    }

    public function places() {
        return $this->belongsToMany(Place::class, 'hotel_places', 'hotel_id', 'place_id');
    }

    public function propertyTypes() {
        return $this->belongsToMany(PropertyType::class, 'hotel_property_types', 'hotel_id', 'property_type_id');
    }

    public function accessibles() {
        return $this->belongsToMany(Accessible::class, 'hotel_accessibles', 'hotel_id', 'accessible_id');
    }

    public function meetingEvents() {
        return $this->belongsToMany(MeetingAndEvent::class, 'hotel_meeting_events', 'hotel_id', 'meeting_id');
    }

    public function states() {
        return $this->belongsToMany(State::class, 'hotel_states', 'hotel_id', 'state_id');
    }

    public function occupancies() {
        return $this->belongsToMany(Occupancy::class, 'hotel_occupancies', 'hotel_id', 'occupancies_id');
    }

    public function deals() {
        return $this->belongsToMany(DealsDiscount::class, 'hotel_deals', 'hotel_id', 'deal_id');
    }

    public function activities() {
        return $this->belongsToMany(TermActivity::class, 'hotel_activities', 'hotel_id', 'activity_id');
    }

    public function locations() {
        return $this->belongsToMany(location::class, 'hotel_locations', 'hotel_id', 'location_id');
    }

    public function detail() {
        return $this->hasOne(HotelDetail::class);
    }

    public function rooms() {
        return $this->hasMany(Room::class);
    }

}
