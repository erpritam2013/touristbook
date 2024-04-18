<?php

namespace App\Models;
use App\Models\Terms\Category;
use App\Models\Terms\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    const ACTIVE = 1;
    const INACTIVE = 0;

    protected $guarded = [];
    protected $casts = [
        'featured_image'=> 'array',
        'gallery'=> 'array'
    ];

    public function sluggable(): Array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

     public function category() {
        return $this->belongsTo(Category::class, 'post_categories', 'post_id', 'category_id');
    }

     public function categories() {
        return $this->belongsToMany(Category::class, 'post_categories', 'post_id', 'category_id');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }

    public function auther()
    {
        return $this->hasOne(User::class,'id','created_by');
    }


}
