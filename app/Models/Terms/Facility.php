<?php

namespace App\Models\Terms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Facility extends Model
{
    use HasFactory;
    use Sluggable;

    const ACTIVE = 1;
    const INACTIVE = 0;

    const HOTEL_TYPE = "Hotel";
    
    
    protected $fillable = [
       'name',
       'slug',
       'description',
       'icon',
       'parent_facility',
       'facility_type',
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
