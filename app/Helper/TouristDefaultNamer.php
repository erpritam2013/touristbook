<?php

namespace App\Helper;

use Spatie\MediaLibrary\Conversions\Conversion;
use Spatie\MediaLibrary\Support\FileNamer\FileNamer;
use App\Models\Media as TableMedia;
use Cviebrock\EloquentSluggable\Services\SlugService;
class TouristDefaultNamer extends FileNamer
{
    public function originalFileName(string $fileName): string
    {
        $get_name = pathinfo($fileName, PATHINFO_FILENAME);
        $fileName_new = SlugService::createSlug(TableMedia::class, 'name', $get_name);
        return $fileName_new;
    }

    public function conversionFileName(string $fileName, Conversion $conversion): string
    {
        $strippedFileName = pathinfo($fileName, PATHINFO_FILENAME);
        $conversion_name = $conversion->getName();
        if ($conversion_name == 'thumbnail'){
           $conversion_name = '100x100';
        }
        return "{$strippedFileName}-{$conversion_name}";
    }

    public function responsiveFileName(string $fileName): string
    {
        return pathinfo($fileName, PATHINFO_FILENAME);
    }
}