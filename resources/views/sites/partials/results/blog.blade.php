
@include('sites.partials.results.'.$view.'-posts', [
    'posts' => $posts
])

<div class="paginationCommon blogPagination categoryPagination mb-4">

    {{$posts->onEachSide(1)->links('vendor/pagination/custom-pagination')}}
</div>
