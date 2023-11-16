<?php

namespace App\Models;
use App\Models\GalleryVideo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoGallery extends Model
{
    use HasFactory;

    public function gallery_videos() {
        return $this->hasOne(GalleryVideo::class);
    }
}
