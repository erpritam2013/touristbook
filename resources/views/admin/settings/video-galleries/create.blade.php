@extends('admin.layouts.main')
@section('video_gallery_action', route('admin.settings.video-galleries.store'))
@section('video_gallery_form_method', method_field('POST'))
@section('title',$title)
@section('content')
<div class="container-fluid">
  @include('admin.layout-parts.breadcrumbs')
    <div class="row">
        <div class="col-lg-12">
            <div class="card main-card">
                <div class="card-header">
                    <h4 class="card-title">{{$title}}</h4>
                    <div align="right">
                        <a href="{{route('admin.settings.video-galleries.index')}}" class="btn btn-dark btn-xs"><i class="fa fa-arrow-right"></i> Back</a>
                    </div>
                </div>
                <div class="card-body">
                    @if(Session::has('success'))
                    {!!get_form_success_msg(Session::get('success'))!!}
                    @endif
                    @if($errors->any())
                    {!!get_body_error_msg($errors)!!}
                    @endif
        
                    <div class="form-validation">
                        @include('admin.settings.video-galleries.form', [
                            'video_gallery' => $video_gallery
                        ])

                    </div> <!-- Form Validation Tag End -->
                </div> <!-- Card Body End -->
            </div> <!-- Card -->
        </div> <!-- 12 Div End -->
    </div> <!-- Row Div End -->
</div> <!-- Container Fluid End -->
@endsection
