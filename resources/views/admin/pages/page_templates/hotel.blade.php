
@if(count($commanAmenity))
<div class="card {{(count($commanAmenity) > 10)?'amenity-card':'amenity-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Comman Amenity</h4>
    </div>
    <div class="card-body">

        <div class="form-group row">
            <input type="text" class="form-control" id="search_amenities" placeholder="Search Amenity......" onkeyup="searchTerm(this)" data-term="amenity-list">
            <div class="col-lg-12 amenity-list border">


                <ul class="checkbox-list">
                    @foreach ($commanAmenity as $commanAmenity_item)
                    <li>
                        <label class="{{ $commanAmenity_item['children'] ? 'parent' : 'child' }}">
                            <input type="checkbox" name="extra_data[hotel_commen_amenities][]" value="{{ $commanAmenity_item['id'] }}" {{ in_array($commanAmenity_item['id'], $page->extra_data['hotel_commen_amenities'] ?? []) ? 'checked' : ''  }}  > {!! $commanAmenity_item['name'] !!}
                        </label>
                        @if ($commanAmenity_item['children']->isNotEmpty())
                        <div class="indent">

                            <label class="{{ $commanAmenity_item['children'] ? 'parent' : 'child' }}">
                                <input type="checkbox" name="extra_data[hotel_commen_amenities][]" value="{{ $commanAmenity_item['id'] }}" {{ in_array($commanAmenity_item['id'], $page->extra_data['hotel_commen_amenities'] ?? []) ? 'checked' : ''  }}  > {!! $commanAmenity_item['name'] !!}
                            </label>

                        </div>
                        @endif
                    </li>
                    @endforeach
                </ul>

            </div>

        </div>
    </div>
</div>
@endif

@if(count($commanPropertyType))

<div class="card {{(count($commanPropertyType) > 10)?'property-types-card':'property-types-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Proparty Type</h4>
    </div>
    <div class="card-body">

        <div class="form-group row">
            <input type="text" class="form-control" id="search_proparty_type" placeholder="Search Proparty Type......" onkeyup="searchTerm(this)" data-term="property-type-list">
            <div class="col-lg-12 property-type-list">

                   <ul class="checkbox-list">
                    @foreach ($commanPropertyType as $commanPropertyType_item)
                    <li>
                        <label class="{{ $commanPropertyType_item['children'] ? 'parent' : 'child' }}">
                            <input type="checkbox" name="extra_data[hotel_common_property_type][]" value="{{ $commanPropertyType_item['id'] }}" {{ in_array($commanPropertyType_item['id'], $page->extra_data['hotel_common_property_type'] ?? []) ? 'checked' : ''  }}  > {!! $commanPropertyType_item['name'] !!}
                        </label>
                        @if ($commanPropertyType_item['children']->isNotEmpty())
                        <div class="indent">

                            <label class="{{ $commanPropertyType_item['children'] ? 'parent' : 'child' }}">
                                <input type="checkbox" name="extra_data[hotel_common_property_type][]" value="{{ $commanPropertyType_item['id'] }}" {{ in_array($commanPropertyType_item['id'], $page->extra_data['hotel_common_property_type'] ?? []) ? 'checked' : ''  }}  > {!! $commanPropertyType_item['name'] !!}
                            </label>

                        </div>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</div>
@endif

@if(count($commanMedicareAssistances))
<div class="card {{(count($commanMedicareAssistances) > 10)?'medicare-assistance-card':'medicare-assistance-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Medicare Assistance</h4>
    </div>
    <div class="card-body">

        <div class="form-group row">
            <input type="text" class="form-control" id="search_commanMedicareAssistances" placeholder="Search Medicare Assistance......" onkeyup="searchTerm(this)" data-term="medicare-assistance-list">
            <div class="col-lg-12 medicare-assistance-list">

                 <ul class="checkbox-list">
                    @foreach ($commanMedicareAssistances as $commanMedicareAssistances_item)
                    <li>
                        <label class="{{ $commanMedicareAssistances_item['children'] ? 'parent' : 'child' }}">
                            <input type="checkbox" name="extra_data[hotel_common_medicare_assistance][]" value="{{ $commanMedicareAssistances_item['id'] }}" {{ in_array($commanMedicareAssistances_item['id'], $page->extra_data['hotel_common_medicare_assistance'] ?? []) ? 'checked' : ''  }}  > {!! $commanMedicareAssistances_item['name'] !!}
                        </label>
                        @if ($commanMedicareAssistances_item['children']->isNotEmpty())
                        <div class="indent">

                            <label class="{{ $commanMedicareAssistances_item['children'] ? 'parent' : 'child' }}">
                                <input type="checkbox" name="extra_data[hotel_common_medicare_assistance][]" value="{{ $commanMedicareAssistances_item['id'] }}" {{ in_array($commanMedicareAssistances_item['id'], $page->extra_data['hotel_common_medicare_assistance'] ?? []) ? 'checked' : ''  }}  > {!! $commanMedicareAssistances_item['name'] !!}
                            </label>

                        </div>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</div>
@endif
@if(count($commanMeetingAndEvent))
<div class="card {{(count($commanMeetingAndEvent) > 10)?'meetings-and-event-card':'meetings-and-event-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Meetings And Event</h4>
    </div>
    <div class="card-body">

        <div class="form-group row">
            <input type="text" class="form-control" id="search_commanMeetingAndEvent" placeholder="Search Medicare Assistance......" onkeyup="searchTerm(this)" data-term="meetings-and-event-list">
            <div class="col-lg-12 meetings-and-event-list">

                 <ul class="checkbox-list">
                    @foreach ($commanMeetingAndEvent as $commanMeetingAndEvent_item)
                    <li>
                        <label class="{{ $commanMeetingAndEvent_item['children'] ? 'parent' : 'child' }}">
                            <input type="checkbox" name="extra_data[hotel_common_meetings_and_events][]" value="{{ $commanMeetingAndEvent_item['id'] }}" {{ in_array($commanMeetingAndEvent_item['id'], $page->extra_data['hotel_common_meetings_and_events'] ?? []) ? 'checked' : ''  }}  > {!! $commanMeetingAndEvent_item['name'] !!}
                        </label>
                        @if ($commanMeetingAndEvent_item['children']->isNotEmpty())
                        <div class="indent">

                            <label class="{{ $commanMeetingAndEvent_item['children'] ? 'parent' : 'child' }}">
                                <input type="checkbox" name="extra_data[hotel_common_meetings_and_events][]" value="{{ $commanMeetingAndEvent_item['id'] }}" {{ in_array($commanMeetingAndEvent_item['id'], $page->extra_data['hotel_common_meetings_and_events'] ?? []) ? 'checked' : ''  }}  > {!! $commanMeetingAndEvent_item['name'] !!}
                            </label>

                        </div>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</div>
@endif
@if(count($commanDealsDiscount))
<div class="card {{(count($commanDealsDiscount) > 10)?'deals-discount-card':'deals-discount-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Deals Discount</h4>
    </div>
    <div class="card-body">

        <div class="form-group row">
            <input type="text" class="form-control" id="search_commanDealsDiscount" placeholder="Search Deals Discount......" onkeyup="searchTerm(this)" data-term="deals-discount-list">
            <div class="col-lg-12 deals-discount-list">

                  <ul class="checkbox-list">
                    @foreach ($commanDealsDiscount as $commanDealsDiscount_item)
                    <li>
                        <label class="{{ $commanDealsDiscount_item['children'] ? 'parent' : 'child' }}">
                            <input type="checkbox" name="extra_data[hotel_common_deals_discount][]" value="{{ $commanDealsDiscount_item['id'] }}" {{ in_array($commanDealsDiscount_item['id'], $page->extra_data['hotel_common_deals_discount'] ?? []) ? 'checked' : ''  }}  > {!! $commanDealsDiscount_item['name'] !!}
                        </label>
                        @if ($commanDealsDiscount_item['children']->isNotEmpty())
                        <div class="indent">

                            <label class="{{ $commanDealsDiscount_item['children'] ? 'parent' : 'child' }}">
                                <input type="checkbox" name="extra_data[hotel_common_deals_discount][]" value="{{ $commanDealsDiscount_item['id'] }}" {{ in_array($commanDealsDiscount_item['id'], $page->extra_data['hotel_common_deals_discount'] ?? []) ? 'checked' : ''  }}  > {!! $commanDealsDiscount_item['name'] !!}
                            </label>

                        </div>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</div>
@endif
@if(count($commanTermActivity))
<div class="card {{(count($commanTermActivity) > 10)?'activities-card':'activities-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Activities</h4>
    </div>
    <div class="card-body">

        <div class="form-group row">
            <input type="text" class="form-control" id="search_activities" placeholder="Search Activities......" onkeyup="searchTerm(this)" data-term="activities-list">
            <div class="col-lg-12 activities-list">

                     <ul class="checkbox-list">
                    @foreach ($commanTermActivity as $commanTermActivity_item)
                    <li>
                        <label class="{{ $commanTermActivity_item['children'] ? 'parent' : 'child' }}">
                            <input type="checkbox" name="extra_data[hotel_common_activities][]" value="{{ $commanTermActivity_item['id'] }}" {{ in_array($commanTermActivity_item['id'], $page->extra_data['hotel_common_activities'] ?? []) ? 'checked' : ''  }}  > {!! $commanTermActivity_item['name'] !!}
                        </label>
                        @if ($commanTermActivity_item['children']->isNotEmpty())
                        <div class="indent">

                            <label class="{{ $commanTermActivity_item['children'] ? 'parent' : 'child' }}">
                                <input type="checkbox" name="extra_data[hotel_common_activities][]" value="{{ $commanTermActivity_item['id'] }}" {{ in_array($commanTermActivity_item['id'], $page->extra_data['hotel_common_activities'] ?? []) ? 'checked' : ''  }}  > {!! $commanTermActivity_item['name'] !!}
                            </label>

                        </div>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</div>
@endif

<style>
    .parent {
        font-weight: bold;
    }

    .child {
        font-weight: normal;
    }

    .indent {
        margin-left: 20px; /* Adjust as needed for indentation */
    }
</style>