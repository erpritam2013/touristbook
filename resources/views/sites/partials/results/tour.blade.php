<div class="resultBar barSpaceAdjust">
    <h2>We found <span>{{$tours->total()}}</span> Results for you</h2>
@if(!isMobileDevice())
    <ul class="list-inline">
        <li class="{{$view == 'list' ? 'active' : ''}}"><a href="javascript:void(0);" class="view-changer" view-id="list"><i class="fa fa-th-list" aria-hidden="true"></i></a></li>

        <li class="{{$view == 'grid' ? 'active' : ''}}"><a href="javascript:void(0);" class="view-changer" view-id="grid"><i class="fa fa-th" aria-hidden="true"></i></a></li>

    </ul>
     @endif
</div>

@include('sites.partials.results.'.$view.'-tours', [
    'tours' => $tours
])


<div class="paginationCommon blogPagination categoryPagination">

    {{$tours->onEachSide(0)->links('vendor/pagination/custom-pagination')}}
</div>
