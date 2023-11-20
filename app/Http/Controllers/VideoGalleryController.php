<?php

namespace App\Http\Controllers;

use App\Models\VideoGallery;
use App\Models\GalleryVideo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\DataTables\VideoGalleryDataTable;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Video Gallery';
        $data['video_gallery'] = new VideoGallery();

        return view('admin.settings.video-galleries.create', $data);
    }

    public function gallery_videos(Request $request)
    {
        $data = $request->all();
        Session::set('gallery_videos',[]);
        Session::put('gallery_videos',$data);
        // $data['gallery_videos'] = VideoGallery::find()
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
