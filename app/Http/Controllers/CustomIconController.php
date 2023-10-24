<?php

namespace App\Http\Controllers;

use App\Models\CustomIcon;
use App\Http\Requests\StoreCustomIconRequest;
use App\Http\Requests\UpdateCustomIconRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\DataTables\CustomIconDataTable;
use Illuminate\Support\Facades\Storage;
use Session;
use Image;
class CustomIconController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CustomIconDataTable $dataTable)
    {
        $data['custom_icons'] = CustomIcon::count();
        $data['title'] = 'Custom Icon List';

        return $dataTable->render('admin.settings.custom-icons.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomIconRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomIconRequest $request):JsonResponse
    {

        if ($request->action == 'custom_icon_image_upload') {
          //dd($request->file('icon'));
           $file = $request->file('icon');
           if (!empty($file)) {


               $basedir = storage_path();
               $baseurl = asset('storage');
       //  dd(pathinfo($file->get('name'), PATHINFO_FILENAME));
               $folderName = 'icon-images/';
               $fileName = pathinfo($request->icon->getClientOriginalName(), PATHINFO_FILENAME);

               $fileNameSingle = $folderName.$this->sanitize_title($fileName);


               $slug_name = basename($fileNameSingle);
               $existed_title = $this->icon_existed_title($slug_name);
               if (!$existed_title) {
                  $sourceProperties = getimagesize($file->getRealPath());
                  $fileExt = pathinfo($request->icon->getClientOriginalName(), PATHINFO_EXTENSION);
                  $file_url = $baseurl.'/'.$fileNameSingle.'.'. $fileExt;
                  $uploadImageType = $sourceProperties['mime'];
                  $sourceImageWidth = $sourceProperties[0];
                  $sourceImageHeight = $sourceProperties[1];

                  $image_name = str_replace('-', " ", basename($fileNameSingle));
                  $image_fullname = $slug_name.'.'.$fileExt;
                    //$resourceType = $this->imagecreatefromjpeg($file->getRealPath()); 
                    // $imageLayer = $this->resizeImage(null,$sourceImageWidth,$sourceImageHeight);
                  $destinationPath = public_path('storage/').$folderName.'/';
            //   $resize_d = ResizeImage::make($request->file('icon'))
            // ->resize(110, 110)
            // ->save($destinationPath . $image_fullname);

                  $icon = Image::make($request->file('icon'))
                  ->resize(110, 110, function ($constraint) { $constraint->aspectRatio(); } )
                  ->encode('jpg',90);

                  Storage::disk('public')->put( $folderName.$image_fullname, $icon);

            //   $new_image = Image::make($file->getRealPath());
            //   if($new_image != null){
            //     $image_width= $new_image->width();
            //     $image_height= $new_image->height();
            //     $new_width= 110;
            //     $new_height= 110;

            //     $new_image->resize($new_width, $new_height, function    ($constraint) {
            //        $constraint->aspectRatio();
            //    })->save($destinationPath.'/'.$image_fullname);
            //    // $store_image= $new_image->save(storage_path($folderName, $image_fullname));
            //    // $file->move($destinationPath, $image_fullname);
            //  $file->storeAs($folderName, $image_fullname, 'public');
            // }
                  $insert_icon['title'] = ucwords($image_name);
                  $insert_icon['slug'] = $slug_name;
                  $insert_icon['type'] = $uploadImageType;
                  $insert_icon['mime'] = $uploadImageType;
                  $insert_icon['path'] = $fileNameSingle. ".". $fileExt;
                  $insert_icon['uri'] = $baseurl.'/'.$fileNameSingle.".". $fileExt;
                    // dd($insert_icon);
                  $custom_icon = CustomIcon::create($insert_icon);
                  if ($custom_icon) {
                     
                    return response()->json(['success'=>true]);
                }

            }else{
             return response()->json(['success'=>false,'data'=>$file]);
         }

     }else{
        return response()->json(['err'=>true]);
    }

}else{
    return response()->json(['err'=>true]);;
}
}

public function sanitize_title($title='')
{
     $title = str_replace(' ', '-', $title); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $title); // Removes special chars.
}

 // public function imagecreatefromjpeg($fileName)
 // {
 //     return @imagecreatefromjpeg($fileName);
 // }

//  public function resizeImage($resourceType,$image_width,$image_height) {
//     $resizeWidth = 110;
//     $resizeHeight = 110;
//     $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
//     imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
//     return $imageLayer;
// }

public function icon_existed_title($slug=null)
{
    if (!empty($slug)) {
        $status = false;
        $result = CustomIcon::where('slug',$slug)->get();
        if (count($result)) {
            $status = true;
        }
    }

    return $status;
}
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomIcon  $customIcon
     * @return \Illuminate\Http\Response
     */
    public function show(CustomIcon $customIcon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomIcon  $customIcon
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomIcon $customIcon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomIconRequest  $request
     * @param  \App\Models\CustomIcon  $customIcon
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomIconRequest $request, CustomIcon $customIcon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomIcon  $customIcon
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomIcon $customIcon)
    {

        Storage::disk('public')->delete($customIcon->path);
        $customIcon->delete();
        Session::flash('success','Custom Icon Deleted Successfully');
        return back();
    }

    public function bulk_delete(Request $request)
    {
        if (!empty($request->ids)) {

            $customIconIds = get_array_mapping(json_decode($request->ids));
            foreach ($customIconIds as $id) {
              $custom_icon = CustomIcon::find($id);
              if (!empty($custom_icon)) {

                  Storage::disk('public')->delete($custom_icon->path);
              }
          }
          CustomIcon::whereIn('id', $customIconIds)->delete();
          Session::flash('success', 'Custom Icon Bulk Deleted Successfully');
      }
      return back();
  }
}
