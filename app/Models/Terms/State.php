<?php

namespace App\Models\Terms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class State extends Model
{
    use HasFactory;
     use Sluggable;

    const ACTIVE = 1;
    const INACTIVE = 0;

      protected $fillable = [
       'name',
       'slug',
       'description',
       'icon',
       'parent_state',
       'country',
       'extra_data',
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
