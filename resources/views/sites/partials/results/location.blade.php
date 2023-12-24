<div class="resultBar barSpaceAdjust">
    <h2>We found <span>{{$locations->total()}}</span> Results for you</h2>
    <ul class="list-inline d-none">

        <li class="grid active"><a href="javascript:void(0);" class="view-changer" view-id="grid"><i class="fa fa-th" aria-hidden="true"></i></a></li>

    </ul>
</div>

@include('sites.partials.results.grid-locations', [
    'locations' => $locations
])


<div class="paginationCommon blogPagination categoryPagination">

    {{$locations->onEachSide(0)->links('vendor/pagination/custom-pagination')}}
</div>
