<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class ActivityZone extends Model
{
    use HasFactory,Sluggable;

    protected $table = "activity_zones";
    protected $guarded = [];
    protected $casts = [
        'activity_zone_section'=>'array',
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
