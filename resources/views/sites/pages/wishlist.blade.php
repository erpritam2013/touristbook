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
    $banner_image = (!empty($page->featured_image) && isset($page->featured_image[0]['id']))?getConversionUrl($page->featured_image[0]['id'],'1200x400'):null;
}

@endphp

@include('sites.partials.banner-2', [
'bannerUrl' => $banner_image ?? asset('sites/images/dummy/1200x400.jpg'),
'bannerTitle' => 'Wishlist',
'bannerSubTitle' => '',
])

<div class="section" style="{!!$top ?? ''!!}">
    <div class="container">
            <div class="map-content-loading">
                <div class="st-loader"></div>
            </div>
        <div class="search-form hotel-service">
            <div class="row">
                <!-- blog item-->
                <div class="col-lg-12 col-12 align-self-center mt-4">

                    @include('sites.partials.breadcrumb',['location_route'=>"",'location_name'=> '','post_name'=>ucwords($title ?? '')])
                </div>
                <!--Wishlist Content Start-->
                @if($hotels->isNotEmpty())
                <div class="col-sm-12 mb-2">
                    <h5 class="text-left mb-4">Hotels</h5>
                    <div class="table-responsive-sm">
                        <table class="table table-lg table-noborder table-striped">
                            <thead class="all-text-white bg-grad">
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($hotels as $hotel)

                              @php 
                              $featured_image_hotel = (!empty($hotel->featured_image) && isset($hotel->featured_image[0]['id']))?getConversionUrl($hotel->featured_image[0]['id'],'thumbnail'):null;

                              @endphp


                              <tr>
                                <td><img src="{{$featured_image_hotel ?? asset('sites/images/dummy/100x100.jpg')}}" width="100" height="100"></td>
                                <td>{{$hotel->name}}</td>
                                <td>{!!get_price($hotel)!!}</td>
                                <td>
                                    <a href="{{route('hotel',$hotel->slug)}}" class="btn btn-grad btn-sm" target="_blank">View Detail</a>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-sm wishlist-remove" data-model_type="Hotel" data-model_id="{{$hotel->id}}" data-status="1"><i class="fa fa-times fa-lg" ></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            @if($tours->isNotEmpty())
            <div class="col-sm-12 mb-2">
                <h5 class="text-left mb-4">Tours</h5>
                <div class="table-responsive-sm">
                    <table class="table table-lg table-noborder table-striped">
                        <thead class="all-text-white bg-grad">
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($tours as $tour)
                          @php 
                          $featured_image_tour = (!empty($tour->featured_image) && isset($tour->featured_image[0]['id']))?getConversionUrl($tour->featured_image[0]['id'],'thumbnail'):null;
                          @endphp
                          <tr>
                           <td><img src="{{$featured_image_tour ?? asset('sites/images/dummy/100x100.jpg')}}" width="100" height="100"></td>
                           <td>{{$tour->name}}</td>
                           <td>{!!get_price($tour)!!}</td>
                           <td>
                            <a href="{{route('tour',$tour->slug)}}" class="btn btn-grad btn-sm" target="_blank" >View Detail</a>
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm wishlist-remove" data-model_type="Tour" data-model_id="{{$tour->id}}" data-status="1"><i class="fa fa-times fa-lg"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    @if($activities->isNotEmpty())
    <div class="col-sm-12 mb-2">
        <h5 class="text-left mb-4">Activities</h5>
        <div class="table-responsive-sm">
            <table class="table table-lg table-noborder table-striped">
                <thead class="all-text-white bg-grad">
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($activities as $activity)
                  @php 
                  $featured_image_activity = (!empty($activity->featured_image) && isset($activity->featured_image[0]['id']))?getConversionUrl($activity->featured_image[0]['id'],'thumbnail'):null;
                  @endphp
                  <tr>
                    <td><img src="{{$featured_image_activity ?? asset('sites/images/dummy/100x100.jpg')}}" width="100" height="100"></td>
                    <td>{{$activity->name}}</td>
                    <td>{!!get_price($activity)!!}</td>
                    <td>
                        <a href="{{route('activity',$activity->slug)}}" class="btn btn-grad btn-sm" target="_blank">View Detail</a>
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm wishlist-remove" data-model_type="Activity" data-model_id="{{$activity->id}}" data-status="1"><i class="fa fa-times fa-lg"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

<!--Wishlist Content End-->
@if(!$hotels->isNotEmpty() && !$tours->isNotEmpty() && !$activities->isNotEmpty())
<!-- Wishlist Empty Content -->
<div class="col-sm-12 text-center empty-page mb-5">
    <i class="fa fa-heart" style="font-size:150px;color:#ebecee;animation: bounce 2s infinite;transition: all 0.3s ease;"></i>
    <h2>Wishlist is empty!</h2>
    <p class="mb-3 pb-1">No Items were added to the Wish List.</p>
    <a href="{{route('hotels')}}" class="btn btn-grad btn-sm">Hotels</a>
    <a href="{{route('our-packages')}}" class="btn btn-grad btn-sm">Tours</a>
    <a href="{{route('activities')}}" class="btn btn-grad btn-sm">Activities</a>
</div>
@endif
<!-- End Wishlist Empty Content -->

</div>
</div>
</div>

@endsection
