<div class="Filter-left">
    <h3 class="Filter-left-title">FILTER BY <div id="btn-clear-filter" class="btn-clear-filter" style="display: none;">Clear filter</div></h3>
    <form action="#" autocomplete="off">

        @include('sites.partials.filters.priceFilter')

        @include('sites.partials.filters.propertyTypeFilter')

        @include('sites.partials.filters.amenitiesFilter')

        @include('sites.partials.filters.medicareAssistanceFilter')

        @include('sites.partials.filters.meetingAndEventsFilter')

        @include('sites.partials.filters.dealDiscountFilter')

        @include('sites.partials.filters.activitiesFilter')


    </form>
</div>
