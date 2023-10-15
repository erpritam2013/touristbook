@extends('sites.layouts.main')
@section('title',$title)
@section('content')
    @include('sites.partials.banner', [
        'bannerUrl' => asset('sites/images/banner/hotel.jpg'),
        'bannerTitle' => 'Hotels',
        'bannerSubTitle' => '',
    ])

    <div class="search-form-wrapper hidden-xs hidden-sm">
    <div class="container">
        <div class="search-form hotel-service">
          
            <!--Address-->

                <form action="" class="form" method="get">
               <div class="row">
            <div class="col-md-8 border-right">
                <div class="form-group form-extra-field  clearfix field-detination has-icon open">
                  {!!getNewIcon('ico_maps_search_box', '#000000', '24px', '24px', true)!!}

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
