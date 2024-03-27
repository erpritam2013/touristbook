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
'bannerTitle' => 'About',
'bannerSubTitle' => '',
])

<div class="section" style="{!!$top ?? ''!!}">
    <div class="container">
        <div class="row">
            <!-- blog item-->
            <div class="col-lg-12 col-12 align-self-center mt-4">

                @include('sites.partials.breadcrumb',['location_route'=>"",'location_name'=> '','post_name'=>ucwords($title ?? '')])
            </div>
            <!--About Content Start-->
            @if(isset($page->extra_data['about_info']) && !empty($page->extra_data['about_info']))
            @foreach($page->extra_data['about_info'] as $about_info)
            <div class="col-lg-12 col-12 align-self-center mt-4">
                <div class="about-content">
                    <div class="desc">
                        {!!$about_info['about_info-description'] ?? ''!!}
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            <!--About Content End-->

        </div>
    </div>
</div>

@if(isset($page->extra_data['about_team']) && !empty($page->extra_data['about_team']))
    <!-- =======================
        team style default -->
        <section class="team pt40 pb20">
            <div class="container">
                <div class="row mb-5 text-center">
                    <div class="col-md-12">
                        <h4 class="team-main-heading">Our Team</h4>
                    </div>
                </div>
                <div class="row">
                    <!-- Team item -->
                    @foreach($page->extra_data['about_team'] as $key => $about_team)
                    @php 
                    $about_team_image_arr = (!empty($about_team['about_team-image']))?json_decode($about_team['about_team-image'],true):[];
                    $about_team_image = (!empty($about_team_image_arr) && isset($about_team_image_arr[0]['id']))?getConversionUrl($about_team_image_arr[0]['id'],'400x417'):null;
                    @endphp
                    <div class="col-sm-6 col-md-4 {{$key == 6?'d-none':''}}">
                        <div class="team-item text-center ">
                            <div class="team-avatar-touristbook">
                                <img src="{{$about_team_image ?? asset('sites/images/dummy/400x417.jpg')}}" alt="about-team-image" >
                            </div>

                            <div class="team-desc team-desc-touristbook">
                                <h5 class="team-name">{{$about_team['about_team-name']}}</h5>
                                <span class="team-position">{{$about_team['about_team-position']}}</span>
                                {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque id luctus elit.</p>--}}
                                <ul class="social-icons si-colored-on-hover">
                                    <li class="social-icons-item social-facebook"><a class="social-icons-link" href="{{$about_team['about_team-facebook'] ?? '#'}}"><i class="fab fa-facebook-f"></i></a></li>
                                    <li class="social-icons-item social-instagram"><a class="social-icons-link" href="{{$about_team['about_team-instagram'] ?? '#'}}"><i class="fab fa-instagram"></i></a></li>
                                    <li class="social-icons-item social-twitter"><a class="social-icons-link" href="{{$about_team['about_team-twitter'] ?? '#'}}"><i class="fab fa-twitter"></i></a></li>
                                    <li class="social-icons-item social-youtube"><a class="social-icons-link" href="{{$about_team['about_team-youtube'] ?? '#'}}"><i class="fab fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- row end -->
            </div>
        </section>
        @endif
    <!-- =======================
        team style default -->
        @endsection
