
@include('sites.partials.results.'.$view.'-posts', [
    'posts' => $posts
])

<div class="paginationCommon blogPagination categoryPagination">

    {{$posts->onEachSide(0)->links('vendor/pagination/custom-pagination')}}
</div>
