<?php

namespace App\Models;
use App\Models\GalleryVideo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoGallery extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function gallery_videos() {

        return $this->hasMany(GalleryVideo::class);
    }  

    public function gallery_video_detail() {

        return $this->hasOne(GalleryVideo::class);
    }
}
