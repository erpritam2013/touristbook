<?php

namespace App\Models\Terms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class TopService extends Model
{
    use HasFactory;
    use Sluggable;

      protected $fillable = [
       'name',
       'slug',
       'description',
       'icon',
       'parent_top_service',
       'top_service_type',
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
