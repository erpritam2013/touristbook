<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Media;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function loadImages(Request $request) {
        $pageNumber = 1;
        if($request->has('page')) {
            $pageNumber = $request->get('page');
        }

        $mediaQuery = Media::orderBy("created_at", "desc");

        if($request->has('searchTxt') && !empty($request->get('searchTxt'))) {
            $searchTxt = $request->get('searchTxt');
            $mediaQuery->where('file_name', 'LIKE', '%'.$searchTxt.'%')->orWhere('name', 'LIKE', '%'.$searchTxt.'%');
        }
        // $mediaQuery->get('id')
         //$item->responsive_images = getConversionUrl($item->id,'thumbnail');
         $media_list = $mediaQuery->paginate(20, ['*'], 'page', $pageNumber);
         $media_list->reduce(function($carry, $item){
           $item->thumbnail = getConversionUrl($item->id,'thumbnail');
           return $item;

         });
        return response()->json($media_list);
    }

    public function uploadImages(Request $request) {
        $uploadedFile = $request->file('file');
        // TODO: Need to Improve
        $file = new File();

        $file->save();

        $file->addMedia($uploadedFile)
            ->toMediaCollection('images');

        $media = $file->getMedia('images')->first();

        return [
            'url' => $media->getUrl(),
            'id' => $media->id,
            'name' => $media->name,
            'thumbnail' => $file->getFirstMediaUrl('images','thumbnail')
        ];
    }
}