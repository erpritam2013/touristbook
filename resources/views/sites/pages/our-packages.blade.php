@extends('sites.layouts.main')
@section('title',$title)

@section('content')
    @include('sites.partials.banner', [
        'bannerUrl' => asset('sites/images/banner/hotel.jpg'),
        'bannerTitle' => 'Our Packages',
        'bannerSubTitle' => '',
    ])

 
    <div class="search-form-wrapper hidden-xs hidden-sm">
    <div class="container">
        <div class="search-form hotel-service">
          
            <!--Address-->

                <form action="" class="form" method="get">
               <div class="row">
            <div class="col-md-9 border-right">
                <div class="form-group form-extra-field  clearfix field-detination has-icon open">
                  {!!getNewIcon('ico_maps_search_box', '#000000', '24px', '24px', true)!!}
                <input type="text" class="main-search-box" placeholder="Where are your going?" id="input-search-box" name="search" value="{{$searchTerm}}" />
                <input type="hidden" name="source_type" value="{{$sourceType}}" />
                <input type="hidden" name="source_id" value="{{$sourceId}}" />
                </div>
            </div>
            <div class="col-md-3 botton-right-div">
                <div class="btn-wrapper">
                    <button type="submit" class="btn btn-grad search-form-btn">Search</button>
                </div>
            </div>
        </div>
                </form>

        </div>
    </div>
</div>

    <section class=" pb80 cruise-grid-view">
        <div class="map-content-loading">
            <div class="st-loader"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    @include('sites.partials.filters.tour')
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12" id="result-info" data-type="get-tours">

                    
                </div>
            </div>
        </div>
    </section>
@endsection 
