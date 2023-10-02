<?php

namespace App\Models\Terms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class TermActivityList extends Model
{
    use HasFactory,Sluggable;

    const ACTIVE = 1;
    const INACTIVE = 0;

    const HOTEL_TYPE = "Hotel";
    const LOCATION_TYPE = "Location";
    const ACTIVITY_TYPE = "Activity";
    const TOUR_TYPE = "Tour";

      protected $fillable = [
       'name',
       'slug',
       'description',
       'icon',
       'parent',
      // 'term_activity_list_type',
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
