<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Location;
use App\Models\Terms\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class PagesController extends Controller
{
    public function index() {

        return view('sites.pages.home');
    }

    public function hotels(Request $request) {
        $post_type = 'Hotel';
        $searchTerm = $request->get('search');
        $sourceType = $request->get('source_type');
        $sourceId = $request->get('source_id');

        return view('sites.pages.hotels', compact('searchTerm', 'sourceType', 'sourceId','post_type'));
    }
    public function about() {
        $data['post_type'] = 'About';
        $data['title'] = 'About';
        return view('sites.pages.about',$data);
    }
    public function connecting_partners() {
        $data['post_type'] = 'connecting_partners';
        $data['title'] = 'Connecting Partners';
        return view('sites.pages.connecting-partners',$data);
    }

    public function blogs() {

        $data['post_type'] = 'Blog';
        $data['title'] = 'Blogs';
        return view('sites.pages.blogs',$data);
    }
    public function destinations() {

        $data['post_type'] = 'destinations';
        $data['title'] = 'Destinations';
        return view('sites.pages.destinations',$data);
    }
    public function activities() {

        $data['post_type'] = 'activities';
        $data['title'] = 'Activities';
        return view('sites.pages.activities',$data);
    }
    public function our_packages() {

        $data['post_type'] = 'our_packages';
        $data['title'] = 'Our Packages';
        return view('sites.pages.our-packages',$data);
    }
    public function contact() {

        $data['post_type'] = 'contact';
        $data['title'] = 'Contact Us';
        return view('sites.pages.contact',$data);
    }


    public function hotelDetail(Request $request, $slug) {
        $hotel = Hotel::with(['detail', 'amenities', 'medicare_assistances', 'propertyTypes', 'top_services', 'places', 'rooms'])->where('slug', $slug)->first();
        if(!$hotel) {
            abort(404);
        }
        // dd($hotel);

        return view('sites.pages.hotel-detail', compact('hotel'));
    }

    public function getHotels(Request $request, $view = "list") {

        $hotelQuery = Hotel::query();
        $hotelQuery->selectRaw(' hotels.*, hotel_details.latitude, hotel_details.longitude, GROUP_CONCAT(amenities.name) as facilities');

        $hotelQuery->leftJoin('hotel_details', 'hotel_details.hotel_id', '=', 'hotels.id');

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

        // Search Params
        if($request->has('sourceType') && !empty($request->get('sourceType')) && $request->has('sourceId') && !empty($request->get('sourceId'))) {
            $sourceType = $request->get('sourceType');
            $sourceId = $request->get('sourceId');
            if ($sourceType == "state") {
                $hotelQuery->leftJoin('hotel_states', 'hotel_states.hotel_id', '=', 'hotels.id');
                $hotelQuery->where('hotel_states.state_id', $sourceId);
            }else {
                $hotelQuery->leftJoin('hotel_locations', 'hotel_locations.hotel_id', '=', 'hotels.id');
                $hotelQuery->where('hotel_locations.location_id', $sourceId);
            }


        }else if($request->has('searchTerm') && !empty($request->get('searchTerm'))) {
            //search in address
            $searchTerm = $request->get('searchTerm');
            // TODO: JSON Treatment is Pending
            $hotelQuery->where('hotels.address', 'LIKE', '%'.$searchTerm.'%');
        }


        $pageNumber = 1;
        if($request->has('pageNo') && !empty($request->get('pageNo'))) {
            $pageNumber = $request->get('pageNo');
        }


        $hotels = $hotelQuery->groupBy('hotels.id')->paginate(12, ['*'], 'page', $pageNumber);
        // TODO: Include Status Check
        // $hotelQuery->where('status', Hotel::)
        return View::make('sites.partials.results.hotel', ['hotels' => $hotels, 'view' => $view]);

    }

    public function getLocationState(Request $request) {
        $term = $request->get('term');
        $locationQ = Location::selectRaw('id, name, "location" as source_type ')
                            ->where('status', 1)
                            ->where('name', "like", $term.'%');
        $stateQ = State::selectRaw('id, name, "state" as source_type ')
                        ->where('status', 1)
                        ->where('name', "like", $term.'%')
                        ->union($locationQ)
                        ->get();

        $results = [];
        if($stateQ->isNotEmpty()) {
            foreach($stateQ as $stateLocation) {
                array_push($results, [
                    "id" => $stateLocation->id,
                    "label" => $stateLocation->name,
                    "value" => $stateLocation->name,
                    "sourceType" => $stateLocation->source_type
                ]);
            }
        }

        return response()->json($results, 200);

    }
}
