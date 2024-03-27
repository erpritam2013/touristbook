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
              ->quality(80)
              ->keepOriginalImageFormat();
        $this->addMediaConversion('768x576')
              ->width(768)
              ->height(576)
              ->quality(80)
              ->keepOriginalImageFormat();
        $this->addMediaConversion('600x450')
              ->width(600)
              ->height(450)
              ->quality(80)
              ->keepOriginalImageFormat();
        $this->addMediaConversion('450x417')
              ->width(450)
              ->height(417)
              ->quality(80)
              ->keepOriginalImageFormat();
        $this->addMediaConversion('270x200')
              ->width(270)
              ->height(200)
              ->quality(80)
              ->keepOriginalImageFormat();
              
           if (!matchRouteNameMatch('admin')) {
             $this->addMediaConversion('1356x475')
              ->width(1356)
              ->height(475)
              ->quality(80)
              ->keepOriginalImageFormat();

             $this->addMediaConversion('1350x500')
              ->width(1350)
              ->height(500)
              ->quality(80)
              ->keepOriginalImageFormat();
             $this->addMediaConversion('1200x400')
              ->width(1200)
              ->height(400)
              ->quality(80)
              ->keepOriginalImageFormat();
             $this->addMediaConversion('400x417')
              ->width(400)
              ->height(417)
              ->quality(80)
              ->keepOriginalImageFormat();
             $this->addMediaConversion('266x266')
              ->width(266)
              ->height(266)
              ->quality(80)
              ->keepOriginalImageFormat();
           }
    }


 public function get_media()
{
    return $this->belongsTo(tourist_Media::class, 'id', 'model_id');
}

}
