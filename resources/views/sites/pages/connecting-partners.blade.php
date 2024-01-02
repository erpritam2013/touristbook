@extends('sites.layouts.main')
@section('title',$title)
@section('content')

  @php $banner_image = (!empty($page->featured_image) && isset($page->featured_image[0]['id']))?getConversionUrl($page->featured_image[0]['id']):null;@endphp

@include('sites.partials.banner', [
'bannerUrl' => $banner_image ?? asset('sites/images/dummy/1200x400.jpg'),
'bannerTitle' => 'Connecting Partners',
'bannerSubTitle' => '',
])

<div class="section pt-4">
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
