@extends('sites.layouts.main')
@section('title',$title)
@section('content')
@php
    $banner_image = null;
if(isset($page)) {
if(isJson($page->featured_image)){
    $page->featured_image = json_decode($page->featured_image,true);
}
$banner_image = (!empty($page->featured_image) && isset($page->featured_image[0]['id']))?getConversionUrl($page->featured_image[0]['id']):null;
}

@endphp

@include('sites.partials.banner-2', [
'bannerUrl' => $banner_image ?? asset('sites/images/dummy/1200x400.jpg'),
'bannerTitle' => 'Blogs',
'bannerSubTitle' => '',
])


<section class="Blog-list pt80 pb80">
    <div class="map-content-loading">
        <div class="st-loader"></div>
    </div>
     <input type="hidden" name="source_type" value="{{$sourceType}}" />
        @php 
        $type_post = 'get-posts';

        if(isset($tag) && !empty($tag)){
        $type_post = 'get-posts/tag/'.$tag;

        }
        if(isset($category) && !empty($category)){
        $type_post = 'get-posts/category/'.$category;
        }
       
        @endphp
<div class="container" id="result-info" data-type="{{$type_post}}">
    
</div>
</section>
@endsection
