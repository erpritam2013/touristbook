<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
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
        $this->addMediaConversion('450x300')
              ->width(450)
              ->height(300)
              ->quality(100)
              ->keepOriginalImageFormat();
        $this->addMediaConversion('350x250')
              ->width(350)
              ->height(250)
              ->quality(100)
              ->keepOriginalImageFormat();
        $this->addMediaConversion('270x200')
              ->width(270)
              ->height(200)
              ->quality(90)
              ->keepOriginalImageFormat();
    }

  

     
}
