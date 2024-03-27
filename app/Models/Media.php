<?php

namespace App\Models;

use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class Media extends BaseMedia
{
   use Sluggable;
   public function sluggable(): Array
    {
        return [
            'name' => [
                'source' => 'name'
            ]
        ];
    }

}
