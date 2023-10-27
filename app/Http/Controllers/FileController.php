<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Media;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function loadImages() {
        $media_list = Media::orderBy("created_at", "desc")->paginate();
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
            'name' => $media->name
        ];
    }
}
