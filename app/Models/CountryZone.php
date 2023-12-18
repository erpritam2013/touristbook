<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class CountryZone extends Model implements HasMedia
{
    use HasFactory,Sluggable,InteractsWithMedia;

    protected $table = "country_zones";
    protected $guarded = [];
    protected $casts = [
        'country_zone_section'=>'array',
        'country_zone_catering'=>'array',
        'icon'=>'array',
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
