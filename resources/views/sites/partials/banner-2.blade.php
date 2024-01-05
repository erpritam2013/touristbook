<div class="banner" style="
    background:url({{$bannerUrl}}); 
    background-size:cover; 
    background-color: #fff;
    background-position: center;
    background-repeat: no-repeat;
    padding: 81px 0;
    position: relative;">
    <div class="container">
     @if(!isMobileDevice())
     <h1 class="innerpage-title"><span>{{$bannerTitle}}</span></h1>
     @else
     <h1 class="innerpage-title">{{$bannerTitle}}</h1>
     @endif
     <h6 class="subtitle">{{$bannerSubTitle}}</h6>
 </div>
</div>