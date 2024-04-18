@extends('sites.layouts.main')
@section('title',$title)
@section('content')
@if(auth()->check())
@if(auth()->user()->isAdmin() || auth()->user()->isEditor())
@section('get_a_link')
@if(!isMobileDevice())
@php $top = 'top:32px;position:relative;';@endphp
@endif
{!!get_a_link($title,route('admin.pages.edit',$page->id ?? ''))!!}
@endsection
@endif 
@endif
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
'bannerTitle' => 'Connecting Partners',
'bannerSubTitle' => '',
])

<div class="section" style="{{$top ?? ''}}">
    <div class="container">
        <div class="row">
            <!-- blog item-->
      <div class="col-lg-12 col-12 align-self-center mt-4">
        
        @include('sites.partials.breadcrumb',['location_route'=>"",'location_name'=> '','post_name'=>ucwords($title ?? '')])
      </div>
            <!--About Content Start-->
            @if(isset($page->extra_data['connecting_partners']) && !empty($page->extra_data['connecting_partners']))
            @foreach($page->extra_data['connecting_partners'] as $connecting_partners)
            <div class="col-lg-12 col-12 align-self-center mt-4">
                <div class="about-content">
                    <div class="desc">
                        {!!$connecting_partners['connecting_partners-description'] ?? ''!!}
                 </div>
             </div>
         </div>
         @endforeach
         @endif
         <!--About Content End-->

     </div>
 </div>
</div>

@endsection
