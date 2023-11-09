<!-- =======================
 Banner innerpage -->
<div class="innerpage-banner left bg-overlay-dark-7 py-7"
    style="background:url({{$bannerUrl}}) repeat; background-size:cover;">
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
