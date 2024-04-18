<?php

namespace App\Models\Terms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Post;
class Category extends Model
{
     use HasFactory;
    use Sluggable;

    const ACTIVE = 1;
    const INACTIVE = 0;

    const HOTEL_TYPE = "Hotel";
    const POST_TYPE = "Post";
    const LOCATION_TYPE = "Location";
    const ACTIVITY_TYPE = "Activity";
    const TOUR_TYPE = "Tour";

      protected $fillable = [
       'name',
       'slug',
       'description',
       'parent_id',
       'category_type',
       'color',
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

public function posts()
{
    return $this->belongsToMany(Post::class, 'post_categories', 'post_id', 'category_id');
      
}


}
