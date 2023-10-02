<?php

namespace App\Models\Terms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Attraction extends Model
{
    use HasFactory;
     use Sluggable;

    const ACTIVE = 1;
    const INACTIVE = 0;

    const HOTEL_TYPE = "Hotel";
    const ACTIVITY_TYPE = "Activity";

      protected $fillable = [
       'name',
       'slug',
       'description',
       'icon',
       'parent_id',
       'attraction_type',
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
