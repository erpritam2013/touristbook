<?php

namespace App\Models\Terms;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    use Sluggable;

    const ACTIVE = 1;
    const INACTIVE = 0;

    const HOTEL_TYPE = "Hotel";
    const LOCATION_TYPE = "Location";
    const TOUR_TYPE = "Tour";
    const ROOM_TYPE = "Room";

      protected $fillable = [
       'name',
       'slug',
       'description',
       'icon',
       'parent_id',
       'attachment',
       'lebal_type',
       'type',
       'status',
   ];
    public function sluggable(): Array
   {
    return [
        'slug' => [
            'source' => 'name'
        ]
    ];
}
}
