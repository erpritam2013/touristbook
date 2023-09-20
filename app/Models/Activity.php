<?php

namespace App\Models;

use App\Models\location;
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
        'extra_price' => 'array'
    ];

    public function sluggable(): Array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }





    public function attractions() {
        return $this->belongsToMany(Attraction::class, 'activity_attractions', 'activity_id', 'attraction_id');
    }


    public function locations() {
        return $this->belongsToMany(location::class, 'activity_locations', 'activity_id', 'location_id');
    }

    public function languages() {
        return $this->belongsToMany(Language::class, 'activity_language', 'activity_id', 'language_id');
    }

    public function term_activity_lists() {
        return $this->belongsToMany(TermActivityList::class, 'activity_term_activity_lists', 'activity_id', 'term_activity_lists_id');
    }
    public function states() {
        return $this->belongsToMany(State::class, 'activity_states', 'activity_id', 'state_id');
    }

    public function detail() {
        return $this->hasOne(ActivityDetail::class);
    }
}
