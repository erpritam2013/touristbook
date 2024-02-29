<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
class Page extends Model
{
   use HasFactory, Sluggable, SoftDeletes;

    const ACTIVE = 1;
    const INACTIVE = 0;

    protected $guarded = [];
    protected $casts = [
        'featured_image'=> 'array',
        'gallery'=> 'array',
        'extra_data'=>'array'
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
