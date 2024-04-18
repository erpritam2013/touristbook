<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Media as tourist_Media;
class File extends Model implements HasMedia
{
    use InteractsWithMedia;
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
              ->width(100)
              ->height(100)
              ->quality(90)
              ->keepOriginalImageFormat();
        $this->addMediaConversion('768x576')
              ->width(768)
              ->height(576)
              ->quality(100)
              ->keepOriginalImageFormat();
        $this->addMediaConversion('600x450')
              ->width(600)
              ->height(450)
              ->quality(100)
              ->keepOriginalImageFormat();
        $this->addMediaConversion('450x417')
              ->width(450)
              ->height(417)
              ->quality(100)
              ->keepOriginalImageFormat();
    }


 public function get_media()
{
    return $this->belongsTo(tourist_Media::class, 'id', 'model_id');
}

}
