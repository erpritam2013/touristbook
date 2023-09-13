<?php

namespace App\Models;

use App\Models\Terms\Country;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class CountryZone extends Model
{
    use HasFactory,Sluggable;

    protected $table = "country_zones";
    protected $guarded = [];
    protected $casts = [
        'country_zone_section'=>'array',
        'country_zone_catering'=>'array',
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
