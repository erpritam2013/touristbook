<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class ActivityLists extends Model
{
    use HasFactory,Sluggable;

    protected $table = "activity_lists";
    protected $guarded = [];
    protected $casts = [
        'activity_list_section'=>'array',
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
