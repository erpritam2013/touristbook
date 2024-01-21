@if(count($amenities))
<div class="card {{(count($amenities) > 10)?'amenity-card':'amenity-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Amenities</h4>
    </div>
    <div class="card-body">

        <div class="form-group row">
            <input type="text" class="form-control" id="search_amenities" placeholder="Search Amenity......" onchange="searchTerm(this)" data-term="amenity-list">
            <div class="col-lg-12 amenity-list">

            @include('admin.partials.utils.nested_checkbox_list', ['items' => $amenities, 'name'=> 'extra_data[hotel_common_amenities]', 'selected' => $page->extra_data['hotel_common_amenities'] ?? []])
            </div>

        </div>
    </div>
</div>
 @endif

 @if(count($proparty_types))
<div class="card {{(count($proparty_types) > 10)?'proparty-types-card':'proparty-types-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Proparty Type</h4>
    </div>
    <div class="card-body">

        <div class="form-group row">
            <input type="text" class="form-control" id="search_proparty_type" placeholder="Search Proparty Type......" onkeyup="searchTerm(this)" data-term="proparty-type-list">
            <div class="col-lg-12 proparty-type-list">

            @include('admin.partials.utils.nested_checkbox_list', ['items' => $amenities, 'name'=> 'extra_data[hotel_common_property_type]', 'selected' => $page->extra_data['hotel_common_property_type'] ?? []])
            </div>

        </div>
    </div>
</div>
 @endif
 @if(count($medicare_assistance))
<div class="card {{(count($medicare_assistance) > 10)?'medicare-assistance-card':'medicare-assistance-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Medicare Assistance</h4>
    </div>
    <div class="card-body">

        <div class="form-group row">
            <input type="text" class="form-control" id="search_medicare_assistance" placeholder="Search Medicare Assistance......" onkeyup="searchTerm(this)" data-term="medicare-assistance-list">
            <div class="col-lg-12 medicare-assistance-list">

            @include('admin.partials.utils.nested_checkbox_list', ['items' => $amenities, 'name'=> 'extra_data[hotel_common_medicare_assistance]', 'selected' => $page->extra_data['hotel_common_medicare_assistance'] ?? []])
            </div>

        </div>
    </div>
</div>
 @endif
 @if(count($meetings_and_events))
<div class="card {{(count($meetings_and_events) > 10)?'meetings-and-event-card':'meetings-and-event-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Meetings And Event</h4>
    </div>
    <div class="card-body">

        <div class="form-group row">
            <input type="text" class="form-control" id="search_meetings_and_events" placeholder="Search Medicare Assistance......" onkeyup="searchTerm(this)" data-term="meetings-and-event-list">
            <div class="col-lg-12 meetings-and-event-list">

            @include('admin.partials.utils.nested_checkbox_list', ['items' => $amenities, 'name'=> 'extra_data[hotel_common_meetings_and_events]', 'selected' => $page->extra_data['hotel_common_meetings_and_events'] ?? []])
            </div>

        </div>
    </div>
</div>
 @endif
 @if(count($deals_discount))
<div class="card {{(count($deals_discount) > 10)?'deals-discount-card':'deals-discount-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Deals Discount</h4>
    </div>
    <div class="card-body">

        <div class="form-group row">
            <input type="text" class="form-control" id="search_deals_discount" placeholder="Search Deals Discount......" onkeyup="searchTerm(this)" data-term="deals-discount-list">
            <div class="col-lg-12 deals-discount-list">

            @include('admin.partials.utils.nested_checkbox_list', ['items' => $amenities, 'name'=> 'extra_data[hotel_common_deals_discount]', 'selected' => $page->extra_data['hotel_common_deals_discount'] ?? []])
            </div>

        </div>
    </div>
</div>
 @endif
 @if(count($activities))
<div class="card {{(count($activities) > 10)?'activities-card':'activities-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Activities</h4>
    </div>
    <div class="card-body">

        <div class="form-group row">
            <input type="text" class="form-control" id="search_activities" placeholder="Search Activities......" onkeyup="searchTerm(this)" data-term="activities-list">
            <div class="col-lg-12 activities-list">

            @include('admin.partials.utils.nested_checkbox_list', ['items' => $amenities, 'name'=> 'extra_data[hotel_common_activities]', 'selected' => $page->extra_data['hotel_common_activities'] ?? []])
            </div>

        </div>
    </div>
</div>
 @endif