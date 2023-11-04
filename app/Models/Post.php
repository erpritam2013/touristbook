<?php

namespace App\Models;
use App\Models\Terms\Category;
use App\Models\Terms\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;

    const ACTIVE = 1;
    const INACTIVE = 0;

    protected $guarded = [];
    protected $casts = [
        'featured_image'=> 'array'
    ];

    public function sluggable(): Array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

     public function categories() {
        return $this->belongsToMany(Category::class, 'post_categories', 'post_id', 'category_id');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }


}
