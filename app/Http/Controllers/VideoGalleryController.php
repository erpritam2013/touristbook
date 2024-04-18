<?php

namespace App\Http\Controllers;

use App\Models\VideoGallery;
use App\Models\GalleryVideo;
use App\Models\Location;
use App\Models\Terms\State;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\DataTables\VideoGalleryDataTable;
use Illuminate\Support\Facades\View;
use Session;

class VideoGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(VideoGalleryDataTable $dataTable)
    {
       $data['video_galleries'] = VideoGallery::count();
       $data['title'] = 'Video Gallery List';
       return $dataTable->render('admin.settings.video-galleries.index', $data);
   }

   private function _prepare_gallery_videos($id=null) {
    if (!empty($id)) {
        $videoGallery = VideoGallery::find($id); 
        if (empty($videoGallery)) {
            return back();
        }
        // dd($videoGallery);
        // $data['gallery_videos'] = 
        return $videoGallery->gallery_videos()->get(['id','name','image_url','thumb_url','description'])->toArray();
    }
    return [];

}


public function locationState()
{
    $locationQ = Location::selectRaw('id, name, "location" as source_type ')
    ->where('status', 1);
    $stateQ = State::selectRaw('id, name, "state" as source_type ')
    ->where('status', 1)
    ->union($locationQ)
    ->get();

    $results = [];
    if($stateQ->isNotEmpty()) {
        foreach($stateQ as $stateLocation) {
            array_push($results, [
                "id" => $stateLocation->id,
                "label" => $stateLocation->name,
                "value" => $stateLocation->name,
                "sourceType" => $stateLocation->source_type
            ]);
        }
    }
    return $results;
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Video Gallery';
        $data['video_gallery'] = new VideoGallery();

        $data['locations'] = $this->locationState();
    
        return view('admin.settings.video-galleries.create', $data);
    }

    public function gallery_videos(Request $request)
    {
       
        $id = null;
        if(isset($request->id)){
           $id = $request->id;
       }
       $request_data = $request->all();
       if (isset($request->action) && $request->action == 'remove') {
        if (isset($request->video_id) && !empty($request->video_id))  {
          $s_gallery_video = GalleryVideo::find($request->video_id);
          $s_gallery_video->delete();
        }
       }
       $data = [];
       $gallery_videos = $this->_prepare_gallery_videos($id);

       if (count($gallery_videos) > 0) {
          $gallery_videos_count = count($gallery_videos);
          $data['gallery_videos'] = $gallery_videos;
          if (!empty($request_data)) {
            if (isset($request_data['id'])) {
                unset($request_data['id']);
            }
            if (!empty($request_data)) {
                $video = VideoGallery::find($id);
                if (isset($request->gallery_videos) && !empty($request->gallery_videos)) {
                    $request_gallery_videos = json_decode($request_data['gallery_videos'],true);
                    foreach ($request_gallery_videos as $v_key => $v_gallery_video) {
                        
                    if (!empty($video->gallery_videos()->where('image_url',$v_gallery_video['image_url'])->first())) {
                        return response()->json(['error' => 'this video { '.$v_gallery_video['image_url'].' } already added']);
                      }
                    }
                }
                //$video->gallery_videos()->create($request_data);
            }
            if (isset($request->gallery_videos)) {
            $data['gallery_videos'] = array_merge($gallery_videos,json_decode($request_data['gallery_videos'],true));
            }
            //$data['gallery_videos'] =  $this->_prepare_gallery_videos($id);
        }
    }else{
        if (!empty($request_data)) {
         if (isset($request->gallery_videos) && !empty($request->gallery_videos)) {
            
         $data['gallery_videos']= json_decode($request_data['gallery_videos'],true);
         }
     }
     
 }  
 return View::make('admin.settings.video-galleries.gallery-video.videos',$data);
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


       $videoDetails = [
        'name' =>ucwords($request->name),
        'location_id' =>$request->location_id
    ];

    $video = VideoGallery::create($videoDetails);
    if (isset($request->gallery_videos)) {
     $gallery_videos = collect($request->get('gallery_videos'));
     $gallery_videos->each(function ($data) use ($video) {
      $video->gallery_videos()->create($data);
     });
    }

    Session::flash('success','Video Gallery Created Successfully');
    return redirect()->Route('admin.settings.video-galleries.index');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = 'Video Gallery';
        $data['video_gallery'] = VideoGallery::find($id);
        $data['locations'] = $this->locationState();
        return view('admin.settings.video-galleries.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $video = VideoGallery::find($id);
       $videoDetails = [
        'name' =>ucwords($request->name),
        'location_id' =>$request->location_id
    ];

    VideoGallery::where('id',$id)->update($videoDetails);
    if ($request->get('gallery_videos') != null) {
     $gallery_videos = collect($request->get('gallery_videos'));
     $gallery_videos->each(function ($data) use ($video) {

      $video->gallery_videos()->updateOrCreate([
        'id' => $data['id'] ?? null,
    ], $data);
  });
 }
 Session::flash('success','Video Gallery Updated Successfully');
 return redirect()->Route('admin.settings.video-galleries.edit',$id);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function destroy(VideoGallery $videoGallery)
    {
        $videoGallery->delete();
        Session::flash('success','Video Gallery Deleted Successfully');
        return back();
    }

    public function bulk_delete(Request $request)
    {
        if (!empty($request->ids)) {

            $videoGalleryIds = get_array_mapping(json_decode($request->ids));
            VideoGallery::whereIn('id', $videoGalleryIds)->delete();
            Session::flash('success', 'Video Gallery Bulk Deleted Successfully');
        }
        return back();
    }
}
