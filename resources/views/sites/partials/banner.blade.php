<!-- =======================
 Banner innerpage -->
 @php 
 $top = (!isMobileDevice() && auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isEditor()))?"top: 32px;position:relative;":"";
 @endphp
<div class="innerpage-banner left bg-overlay-dark-7 py-7"
    style="background:url({{$bannerUrl}}) repeat; background-size:cover;{!!$top!!}">
    <div class="container">
        <div class="row all-text-white">
            <div class="col-md-12 align-self-center">
                @if(!isMobileDevice())
                <h1 class="innerpage-title"><span>{{$bannerTitle}}</span></h1>
                @else
                <h1 class="innerpage-title">{{$bannerTitle}}</h1>
                @endif
                <h6 class="subtitle">{{$bannerSubTitle}}</h6>
            </div>
        </div>
    </div>
</div>
<!-- =======================
          Banner innerpage -->
