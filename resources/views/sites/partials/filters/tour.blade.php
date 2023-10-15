<div class="Filter-left">
    <h3 class="Filter-left-title">FILTER BY <div id="btn-clear-filter" class="btn-clear-filter" style="display: none;">Clear filter</div></h3>
    <form action="#" autocomplete="off">

        @include('sites.partials.filters.tourPriceFilter')
        @include('sites.partials.filters.durationFilter')

        @include('sites.partials.filters.packageTypeFilter')
        @include('sites.partials.filters.filterTypes')

        


    </form>
</div>
