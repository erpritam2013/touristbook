<?php

namespace App\Models\Terms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Amenity extends Model
{
    use HasFactory;
    use Sluggable;

      protected $fillable = [
       'name',
       'slug',
       'description',
       'icon',
       'parent_amenity',
       'amenity_type',
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
