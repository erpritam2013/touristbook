<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PagesController extends Controller
{
    public function index() {

        return view('sites.pages.home');
    }

    public function hotels() {

        return view('sites.pages.hotels');
    }

    public function getHotels(Request $request, $view = "list") {

        $hotelQuery = Hotel::query();
        $hotelQuery->selectRaw(' hotels.*, GROUP_CONCAT(amenities.name) as facilities');

        $hotelQuery->leftJoin('hotel_amenities', 'hotel_amenities.hotel_id', '=', 'hotels.id');
        $hotelQuery->leftJoin('amenities', 'amenities.id', '=', 'hotel_amenities.amenity_id');

        if($request->has('range') && !empty($request->get('range'))) {
            $range = explode(";", $request->get('range'));
            // TODO: Need Proper Validation
            $minimum = $range[0];
            $maximum = $range[1];

            $hotelQuery->whereBetween("avg_price", [$minimum, $maximum]);
        }

        // Property Types
        if($request->has('propertyTypes') && !empty($request->get('propertyTypes'))) {
            $propertyTypesValue = $request->get('propertyTypes');
            $propertyTypes = explode(",", $propertyTypesValue);
            // No Need Data from Property Type
            $hotelQuery->leftJoin('hotel_property_types', 'hotel_property_types.hotel_id', '=', 'hotels.id');
            $hotelQuery->whereIn('hotel_property_types.property_type_id', $propertyTypes);
        }

        // Amenities
        if($request->has('amenities') && !empty($request->get('amenities'))) {
            $amenitiesValue = $request->get('amenities');
            $amenities = explode(",", $amenitiesValue);
            $hotelQuery->whereIn('hotel_amenities.amenity_id', $amenities);
        }

        // Medicares
        if($request->has('medicares') && !empty($request->get('medicares'))) {
            $medicaresValue = $request->get('medicares');
            $medicares = explode(",", $medicaresValue);
            // No Need Data from Medical Assistancess
            $hotelQuery->leftJoin('hotel_medicare_assistances', 'hotel_medicare_assistances.hotel_id', '=', 'hotels.id');
            $hotelQuery->whereIn('hotel_medicare_assistances.medicare_assistance_id', $medicares);
        }

        // Meetings
        if($request->has('meeting') && !empty($request->get('meeting'))) {
            $meetingsValue = $request->get('meeting');
            $meetings = explode(",", $meetingsValue);
            // No Need Data from Medical Assistancess
            $hotelQuery->leftJoin('hotel_meeting_events', 'hotel_meeting_events.hotel_id', '=', 'hotels.id');
            $hotelQuery->whereIn('hotel_meeting_events.meeting_id', $meetings);
        }

        // Deals
        if($request->has('deals') && !empty($request->get('deals'))) {
            $dealsValue = $request->get('deals');
            $deals = explode(",", $dealsValue);
            // No Need Data from Medical Assistancess
            $hotelQuery->leftJoin('hotel_deals', 'hotel_deals.hotel_id', '=', 'hotels.id');
            $hotelQuery->whereIn('hotel_deals.deal_id', $deals);
        }

        // Activity
        if($request->has('activities') && !empty($request->get('activities'))) {
            $activitiesValue = $request->get('activities');
            $activities = explode(",", $activitiesValue);
            // No Need Data from Medical Assistancess
            $hotelQuery->leftJoin('hotel_activities', 'hotel_activities.hotel_id', '=', 'hotels.id');
            $hotelQuery->whereIn('hotel_activities.activity_id', $activities);
        }
        $pageNumber = 1;
        if($request->has('pageNo') && !empty($request->get('pageNo'))) {
            $pageNumber = $request->get('pageNo');
        }


        $hotels = $hotelQuery->groupBy('hotels.id')->paginate(8, ['*'], 'page', $pageNumber);
        // TODO: Include Status Check
        // $hotelQuery->where('status', Hotel::)
        return View::make('sites.partials.results.hotel', ['hotels' => $hotels, 'view' => $view]);

    }
}
