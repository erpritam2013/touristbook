<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class TourismZone extends Model
{
    use HasFactory,Sluggable;

    protected $table = "tourism_zones";
    protected $guarded = [];
    protected $casts = [
        'tourism_zone'=>'array',
        'image'=>'array',
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
