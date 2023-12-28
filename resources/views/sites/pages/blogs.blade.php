@extends('sites.layouts.main')
@section('title',$title)
@section('content')
@include('sites.partials.banner', [
'bannerUrl' => 'https://touristbook.s3.ap-south-1.amazonaws.com/wp-content/uploads/2023/02/Blog-image-1.jpeg',
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
