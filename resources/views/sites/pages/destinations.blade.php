@extends('sites.layouts.main')
@section('title',$title)
@section('content')
    @include('sites.partials.banner', [
        'bannerUrl' => 'https://touristbook.s3.ap-south-1.amazonaws.com/wp-content/uploads/2023/04/Screenshot-2023-04-02-202920.jpg',
        'bannerTitle' => 'Explore Amazing Destinations',
        'bannerSubTitle' => '',
    ])

@if(!isMobileDevice())
<div class="search-form-wrapper hidden-xs hidden-sm">
    <div class="container">
        <div class="search-form location-service">

            <!--Address-->

            <form action="" class="form" method="get">
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

    <section class="pb20 destination-grid-view">
        <div class="map-content-loading">
            <div class="st-loader"></div>
        </div>
        <div class="container">
            <div class="row">
                {{--<div class="col-lg-3 col-md-3 col-sm-12">
                    @include('sites.partials.filters.hotel')
                </div>--}}
                <div class="col-lg-12 col-md-12 col-sm-12" id="result-info" data-type="get-locations">

                    
                </div>
            </div>
        </div>
    </section>
@endsection 
