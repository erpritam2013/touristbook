<?php

namespace App\Models;
use App\Models\Terms\Place;
use App\Models\LocationMeta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Location extends Model
{
    use HasFactory,Sluggable;;
    protected $guarded = [];

    // protected $casts = [
    //     'location_attributes' => 'array',
    //     'contact' => 'array'
    // ];

    public function sluggable(): Array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    public function places() {
        return $this->belongsToMany(Place::class, 'location_places', 'location_id', 'place_id');
    }
    public function locationMeta(): HasOne
    {
        return $this->hasOne(LocationMeta::class, 'location_id', 'id');
    }
}
