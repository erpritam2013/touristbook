<?php

namespace App\Helper;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class TouristMediaGenerator implements PathGenerator
{
    /*
     * Get the path for the given media, relative to the root storage path.
     */

    public function getPath(Media $media): string
    {
        return $this->getBasePath($media).'/';
    }

    /*
     * Get the path for conversions of the given media, relative to the root storage path.
     */
    public function getPathForConversions(Media $media): string
    {
        return $this->getBasePath($media).'/conversions/';
    }

    /*
     * Get the path for responsive images of the given media, relative to the root storage path.
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getBasePath($media).'/responsive-images/';
    }

    /*
     * Get a unique base path for the given media.
     */
   protected function getBasePath(Media $media): string
    {

        $prefix = config('media-library.prefix', '');

        $customPrefix = "wp-content/uploads/". $media->created_at->year."/". $media->created_at->month;

        if ($prefix !== '') {
            return $prefix . '/'.$customPrefix;
        }

        return $customPrefix;
     }
}
