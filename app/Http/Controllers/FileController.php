<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Media;
use Illuminate\Http\Request;
use App\DataTables\MediaDataTable;
use Session;
use Illuminate\Support\Facades\Storage;
class FileController extends Controller
{


  public function index(MediaDataTable $dataTable)
  {
    $data['media'] = Media::count();
    $data['title'] = 'Media List';
    return $dataTable->render('admin.settings.media-object.index', $data);
}
public function loadImages(Request $request) {
    $pageNumber = 1;
    if($request->has('page')) {
        $pageNumber = $request->get('page');
    }

    $mediaQuery = Media::orderBy("created_at", "desc");

    if($request->has('searchTxt') && !empty($request->get('searchTxt'))) {
        $searchTxt = $request->get('searchTxt');
        $mediaQuery->where('name', 'LIKE', '%'.$searchTxt.'%')->orWhere('file_name', 'LIKE', '%'.$searchTxt.'%');
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

public function destroy(Request $request,$id)
{

    $media = Media::find($id);

    if (!$media) {
     abort(404);
 }
dump($media->generated_conversions);

dump(getImageUrl($id,'800x600'));
 $path  = $media->getPath();
 dump($path);
 dd(Storage::disk('s3')->exists($path));
 if(Storage::disk('s3')->exists($path)) {
    Storage::disk('s3')->delete($path);
}
$media->delete();
Session::flash('success','Media Deleted Successfully');
return back();
}
}