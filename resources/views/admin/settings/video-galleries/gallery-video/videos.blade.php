  @if(!empty($gallery_videos))
  @foreach($gallery_videos as $key => $gallery_video)
  <div class="col-xl-6">
     <div class="card border border-primary p-1">
        <div class="card-body">
         @isset($gallery_video['id'])
         <input type="hidden" name="gallery_videos[{{$key}}][id]" value="{{$gallery_video['id']}}">
         @endisset
             {{--{!!mediaTemplate([
             'name' => 'gallery_videos[][thumb_url]',
             'label' => 'Video Thumb',
             'value' => ,
             'id' => 'gallery-videos-'.$key,
             'smode' => 'single',
             ])!!}--}}
             <div class="form-group row">
               <div class="col-lg-12">
               <label class="col-form-label" for="name-vsign-{{$key}}">Name
               </label>
                <input type="text" class="form-control" id="name-vsign-{{$key}}" name="gallery_videos[{{$key}}][name]" placeholder="Enter a name.." value="{{$gallery_video['name'] ?? ''}}">
             </div>
          </div> 

          <div class="form-group row">
            <div class="col-lg-12">
            <label class="col-form-label" for="description-vsign-{{$key}}">Description
            </label>
               <textarea class="form-control" id="description-vsign-{{$key}}" name="gallery_videos[{{$key}}][description]" rows="2">{{$gallery_video['description'] ?? ''}}</textarea>
            </div>
         </div>
         <div class="form-group row">
            <div class="col-lg-12">
            <label class="col-form-label" for="image_url-vsign-{{$key}}">Url
            </label>
               <input type="url" class="form-control" id="image_url-vsign-{{$key}}" name="gallery_videos[{{$key}}][image_url]" value="{{$gallery_video['image_url'] ?? ''}}" placeholder="Enter a image url.." >
            </div>
         </div>
         {{--<button type="submit" class="btn btn-primary" onclick="EditVideo(this)" data-index="0">Edit Video</button>--}}
         <button type="button" class="btn btn-light"  onclick="RomoveVideo(this)" data-video_id="{{$gallery_video['id'] ?? ''}}" data-video_index="{{$key}}" data-gallery_video_action="{{route('admin.settings.gallery-video')}}">Remove Video</button>

   </div>
</div>
</div>
@endforeach
@endif