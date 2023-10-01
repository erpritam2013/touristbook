<div class="resultBar barSpaceAdjust">
    <h2>We found <span>{{$hotels->total()}}</span> Results for you</h2>
    <ul class="list-inline">
        <li class="{{$view == 'list' ? 'active' : ''}}"><a href="javascript:void(0);" class="view-changer" view-id="list"><i class="fa fa-th-list" aria-hidden="true"></i></a></li>

        <li class="{{$view == 'grid' ? 'active' : ''}}"><a href="javascript:void(0);" class="view-changer" view-id="grid"><i class="fa fa-th" aria-hidden="true"></i></a></li>

    </ul>
</div>


@include('sites.partials.results.'.$view.'-hotels', [
    'hotels' => $hotels
])


<div class="paginationCommon blogPagination categoryPagination">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li> <a href="#" aria-label="Previous"> <span aria-hidden="true"><i class="fa fa-angle-left"
                            aria-hidden="true"></i></span> </a> </li>
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li> <a href="#" aria-label="Next"> <span aria-hidden="true"><i class="fa fa-angle-right"
                            aria-hidden="true"></i></span> </a> </li>
        </ul>
    </nav>
</div>
