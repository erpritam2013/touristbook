<?php

namespace App\Models\Terms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class PackageType extends Model
{
    use HasFactory,Sluggable;


    const ACTIVE = 1;
    const INACTIVE = 0;

    const HOTEL_TYPE = "Hotel";
    const POST_TYPE = "Post";
    const LOCATION_TYPE = "Location";
    const ACTIVITY_TYPE = "Activity";
    const TOUR_TYPE = "Tour";

    protected $guarded = [];
     protected $table = "package_types";

      protected $casts = [
        'extra_data' => 'array'
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
