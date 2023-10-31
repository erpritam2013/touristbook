@extends('sites.layouts.main')
@section('title',$title)
@section('content')
@include('sites.partials.banner', [
'bannerUrl' => asset('sites/images/banner/hotel.jpg'),
'bannerTitle' => 'Activities',
'bannerSubTitle' => '',
])
@if(!isMobileDevice())
<div class="search-form-wrapper hidden-xs hidden-sm">
    <div class="container">
        <div class="search-form hotel-service">

            <!--Address-->

            <form action="" class="form" method="get">
             <div class="row">
                <div class="col-md-8 border-right">
                    <div class="form-group form-extra-field  clearfix field-detination has-icon open">
                      {!!getNewIcon('ico_maps_search_box', '#666666', '24px', '24px', true)!!}
                      <label class="search-form-label">Destination</label>
                      <input type="text" class="main-search-box" placeholder="Where are your going?" id="input-search-box" name="search" value="{{$searchTerm}}" />
                      <input type="hidden" name="source_type" value="{{$sourceType}}" />
                      <input type="hidden" name="source_id" value="{{$sourceId}}" />
                  </div>
              </div>
              <div class="col-md-4 botton-right-div">
                <div class="btn-wrapper">
                    <button type="submit" class="btn btn-grad search-form-btn">Search</button>
                </div>
            </div>
        </div>
    </form>

</div>
</div>
</div>
@else
<div class="container"> 
<div class="search-form-mobile">
<form action="" class="form" method="get">
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

<section class="pb80 cruise-grid-view">
    <div class="map-content-loading">
        <div class="st-loader"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12">
                @include('sites.partials.filters.activity')
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12" id="result-info" data-type="get-activities">


            </div>
        </div>
    </div>
</section>
@endsection 
