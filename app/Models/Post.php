<?php

namespace App\Models;
use App\Models\Terms\Category;
use App\Models\Terms\Tag;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use LamaLama\Wishlist\HasWishlists;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class Post extends Model
{
    use HasFactory, Sluggable, SoftDeletes,HasWishlists;

    const ACTIVE = 1;
    const INACTIVE = 0;

    protected $guarded = [];
    protected $casts = [
        'featured_image'=> 'array',
        'gallery'=> 'array',
        'editing_expiry_time' => 'datetime'
    ];

    public function sluggable(): Array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

     public function edited() {
        $this->fill([
            'editor_id' => Auth::user()->id,
            'is_editing' => true,
            'editing_expiry_time' => Carbon::now()->addMinutes(5)
        ]);
        $this->save();
    }
       public function editor_name()
    {
        if ($this->is_editing && $this->editor_id && !$this->editing_expiry_time->isPast()) {
            return User::find($this->editor_id)->name;
        }


    }
    public function freeEditing() {
        $this->is_editing = false;
        $this->save();
    }
    public function isEditing() {
        return $this->is_editing && !$this->editing_expiry_time->isPast() && $this->editor_id != Auth::user()->id;
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class,'model_id', 'id');
        
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
