@extends('sites.layouts.main')

@section('content')
    @include('sites.partials.banner', [
        'bannerUrl' => asset('sites/images/banner/hotel.jpg'),
        'bannerTitle' => 'Hotels',
        'bannerSubTitle' => '',
    ])

    <div id="map-main" style="height:430px;"></div>

    <section class="pt80 pb80 cruise-grid-view">
        <div class="map-content-loading">
            <div class="st-loader"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    @include('sites.partials.filters.hotel')
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12" id="result-info">9
                </div>
            </div>
        </div>
    </section>
@endsection
