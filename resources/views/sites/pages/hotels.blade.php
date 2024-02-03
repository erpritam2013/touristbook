@extends('sites.layouts.main')
@section('title',$title)
@section('content')
@if(auth()->check())
@if(auth()->user()->isAdmin() || auth()->user()->isEditor())
@section('get_a_link')
@if(!isMobileDevice())
@php 
$top = 'top:32px;position:relative;';
@endphp
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

@if(!isMobileDevice())
@include('sites.partials.banner-2', [
'bannerUrl' => $banner_image ?? asset('sites/images/dummy/1200x400.jpg'),
'bannerTitle' => 'Hotels',
'bannerSubTitle' => '',
])
@else
@include('sites.partials.banner', [
'bannerUrl' => $banner_image ?? asset('sites/images/dummy/1200x400.jpg'),
'bannerTitle' => 'Hotels',
'bannerSubTitle' => '',
])
@endif
@if(!isMobileDevice())
<div class="search-form-wrapper hidden-xs hidden-sm">
    <div class="container">
        <div class="search-form hotel-service">
            <div class="map-content-loading-search-input">
            <div class="st-loader"></div>
        </div>
            <!--Address-->

            <form action="" class="form" method="get" id="search-form-result">
             <div class="row">
                <div class="col-md-8 border-right">
                    <div class="form-group form-extra-field  clearfix field-detination has-icon open">
                      {!!getNewIcon('ico_maps_search_box', '#666666', '24px', '24px', true)!!}

                      <label for="input-search-box" class="lbl-search-box">Destination</label>

                      <input type="text" class="main-search-box" placeholder="Where are your going?" id="input-search-box" name="search" value="{{$searchTerm}}" />
                      <input type="hidden" name="source_type" value="{{$sourceType}}" />
                      <input type="hidden" name="source_id" value="{{$sourceId}}" />
                  </div>
              </div>
              <div class="col-md-4">
                <div class="btn-wrapper">
                    <button type="submit" class="btn btn-grad search-form-btn">Search</button>
                </div>
            </div>
        </div>
    </form>

</div>
<div id="search-result-info"></div>
</div>
</div>
@else
<div class="container"> 
<div class="search-form-mobile">
     <div class="map-content-loading-search-input">
            <div class="st-loader"></div>
        </div>
<form action="" class="form" method="get" id="search-form-result">
    <div class="form-group">
        <div class="dropdown">
            <div class="icon-field">
             {!!getNewIcon('ico_maps_search_box', '#666666', '20px', '20px', true)!!}
         </div>

         <input type="hidden" name="source_type" value="{{$sourceType}}" />
         <input type="hidden" name="source_id" value="{{$sourceId}}" />
         <input type="text" class="main-search-box form-control" placeholder="Where are your going?" id="input-search-box" name="search" value="{{$searchTerm}}" />

     </div>
     <button type="submit" class="btn btn-primary">{!!getNewIcon('ico_search_header', '#ffffff', '25px', '25px', true)!!}</button>
 </div>
 </form>
</div>
</div>
@endif
{{--<div class="container search-box">
    <form method="get">
        <div class="row">
            <div class="col-md-8">
                <label for="input-search-box" class="lbl-search-box">Destination</label>
                
                <input type="text" class="main-search-box" placeholder="Where are your going?" id="input-search-box" name="search" value="{{$searchTerm}}" />
                <input type="hidden" name="source_type" value="{{$sourceType}}" />
                <input type="hidden" name="source_id" value="{{$sourceId}}" />
            </div>
            <div class="col-md-4">
                <div class="btn-wrapper">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </div>
    </form>
</div>--}}

<div id="map-main" style="height:430px;top: -107px;"></div>

<section class="pb80 cruise-grid-view">
    <div class="map-content-loading">
        <div class="st-loader"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12">
                @include('sites.partials.filters.hotel')
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12" id="result-info" data-type="get-hotels">


            </div>
        </div>
    </div>
</section>
@endsection 
