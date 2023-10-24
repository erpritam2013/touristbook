@extends('sites.layouts.main')
@section('title',$title)
@section('content')
    @include('sites.partials.banner', [
        'bannerUrl' => asset('sites/images/banner/hotel.jpg'),
        'bannerTitle' => 'Activities',
        'bannerSubTitle' => '',
    ])

    <div class="container search-box">
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
    </div>

    <section class="pt80 pb80 cruise-grid-view">
        <div class="map-content-loading">
            <div class="st-loader"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    @include('sites.partials.filters.activity')
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12" id="result-info">

                    
                </div>
            </div>
        </div>
    </section>
@endsection 
