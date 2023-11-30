@extends('admin.settings.video-galleries.create')
@section('video_gallery_action', route('admin.settings.video-galleries.update',$video_gallery->id))
@section('video_gallery_form_method')
{{method_field('PUT')}}
<input type="hidden" name="id" data-id="{{$video_gallery->id}}" id="video-gallery-id" value="{{$video_gallery->id}}" data-gallery_video_action="{{route('admin.settings.gallery-video')}}">
@endsection