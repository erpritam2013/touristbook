<?php

namespace App\Models;

use App\Models\RoomDetail;
use App\Models\Hotel;
use App\Models\Location;
use App\Models\Terms\Facility;
use App\Models\Terms\Type;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
class Room extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'extra_price' => 'array',
        'price'=>'float',
        'adult_price'=>'float',
        'child_price'=>'float',
        'featured_image'=> 'array'
        
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
        return $this->belongsToMany(Facility::class, 'room_facilities', 'room_id', 'facility_id');
    }

    public function types() {
        return $this->belongsToMany(Type::class, 'room_types', 'room_id', 'type_id');
    }

      public function locations() {
        return $this->belongsToMany(Location::class, 'room_locations', 'room_id', 'location_id');
    }

    public function hotels() {
        return $this->hasOne(Hotel::class,'id','hotel_id');
    }
    public function detail() {
        return $this->hasOne(RoomDetail::class);
    }
}
