@php
   $video_gallery = GetVideoGallery($location);
 @endphp
@if(!empty($video_gallery))

<div class="row">
@if(!empty($video_gallery->gallery_videos))
@foreach($video_gallery->gallery_videos as $key =>$gallery_video )
@if(!empty($gallery_video->image_url))
@php 
 $video_data = parseVideos($gallery_video->image_url);
@endphp
    <div class="col-md-3 mb-2">
        <!--begin::Custom source(Vimeo)-->
<a
    class="d-block bgi-no-repeat bgi-size-cover bgi-position-center rounded position-relative min-h-175px"
    data-class="d-block"
    data-fslightbox="lightbox-vimeo"
    href="#vimeo-{{$key}}"
    >
    <!--begin::Icon-->
    <img src='{{$video_data["thumbnail"]}}'  class=" translate-middle" alt=""/>
    <!--end::Icon-->
    <button class="ytp-large-play-button ytp-button ytp-large-play-button-red-bg video-btn" aria-label="Play" title="Play"><svg height="100%" version="1.1" viewBox="0 0 68 48" width="100%"><path class="ytp-large-play-button-bg" d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z" fill="#f00"></path><path d="M 45,24 27,14 27,34" fill="#fff"></path></svg></button>
</a>

<iframe id="vimeo-{{$key}}" style="display:none" src="{{$video_data['url']}}" width="1920px" height="1080px" frameBorder="{{$key}}"  allowFullScreen></iframe>
<!--end::Custom source(Vimeo)-->
     <h3 class="st-section-title">{{$gallery_video->name ?? ''}}</h3>
     <div class="video-description">{{shortDescription($gallery_video->description,40) ?? ''}}</div>

    </div>
    @endif
    @endforeach
    @endif
</div>

<script src="{{asset('sites/fslightbox-master/fslightbox.js')}}"></script>

@endif