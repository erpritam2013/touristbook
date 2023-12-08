<?php

namespace App\Http\Controllers;
use App\Interfaces\PageRepositoryInterface;
use App\Models\Hotel;
use App\Models\Page;
use App\Models\Tour;
use App\Models\VideoGallery;
use App\Models\Location;
use App\Models\CustomIcon;
use App\Models\Activity;
use App\Models\Terms\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\DataTables\PageDataTable;
use DB;
class PagesController extends Controller
{

 private PageRepositoryInterface $pageRepository;

 public function __construct(PageRepositoryInterface $pageRepository)
 {
    $this->pageRepository = $pageRepository;
}
public function index() {
 $data['post_type'] = 'Home';
 $data['title'] = 'Home';
 $data['body_class'] = 'home-page';
 return view('sites.pages.home',$data);
}

public function pages(PageDataTable $dataTable)
{
    $pages = $this->pageRepository->getAllPages();
    $data = [
        'title'     => 'Pages',
        'pages'     => $pages->count()
    ];
    return $dataTable->render('admin.pages.index',$data);
}

public function create()
{
    $data['page'] = new Page;
    $data['title'] = 'Add Page';

    return view('admin.pages.create',$data);
}

public function hotels(Request $request) {

    $data['post_type'] = 'Hotel';
    $data['title'] = 'Hotels';
    $data['body_class'] = 'hotel-list-page';
    $data['searchTerm'] = $request->get('search');
    $data['sourceType'] = $request->get('source_type');
    $data['sourceId'] = $request->get('source_id');
    return view('sites.pages.hotels',$data);
}
public function about() {
    $data['post_type'] = 'About';
    $data['title'] = 'About';
    $data['body_class'] = 'about-page';
    return view('sites.pages.about',$data);
}
public function connecting_partners() {
    $data['post_type'] = 'connecting_partners';
    $data['title'] = 'Connecting Partners';
    $data['body_class'] = 'connecting-partners-page';
    return view('sites.pages.connecting-partners',$data);
}

public function blogs() {

    $data['post_type'] = 'Blog';
    $data['title'] = 'Blogs';
    $data['body_class'] = 'blog-page';
    return view('sites.pages.blogs',$data);
}
public function destinations(Request $request) {

    $data['post_type'] = 'Location';
    $data['title'] = 'Destinations';
    $data['body_class'] = 'destinations-page';
    $data['searchTerm'] = $request->get('search');
    $data['sourceType'] = $request->get('source_type');
    $data['sourceId'] = $request->get('source_id');
    return view('sites.pages.destinations',$data);
}
public function activities(Request $request) {

    $data['post_type'] = 'Activity';
    $data['title'] = 'Activities';
    $data['body_class'] = 'activity-list-page';
    $data['searchTerm'] = $request->get('search');
    $data['sourceType'] = $request->get('source_type');
    $data['sourceId'] = $request->get('source_id');

    return view('sites.pages.activities', $data);
}

public function page_templates(Request $request,$view)
{
    return View::make('admin.pages.page_templates.'.$view);
}
public function our_packages(Request $request) {

    $data['post_type'] = 'Tour';
    $data['title'] = 'Our Packages';
    $data['body_class'] = 'tour-list-page';
    $data['searchTerm'] = $request->get('search');
    $data['sourceType'] = $request->get('source_type');
    $data['sourceId'] = $request->get('source_id');

    return view('sites.pages.our-packages', $data);
}
public function contact() {

    $data['post_type'] = 'Contact';
    $data['title'] = 'Contact Us';
    $data['body_class'] = 'contact-us-page';
    return view('sites.pages.contact',$data);
}


public function hotelDetail(Request $request, $slug) {
    $hotel = Hotel::with(['detail', 'amenities', 'medicare_assistances', 'propertyTypes', 'top_services', 'places', 'rooms'])->where('slug', $slug)->first();
    if(!$hotel) {
        abort(404);
    }

    $data['hotel'] = $hotel;
    $data['title'] = 'Hotel :: '.ucwords($hotel->name);
    $data['body_class'] = 'hotel-detail-page';
    $state = $hotel->states()->first();
    $data['nearByHotel'] = collect([]);
    $data['nearByTour'] =  collect([]);
    $data['nearByActivity'] =collect([]);
    $data['nearByLocation'] = collect([]);
    if (!empty($state->id)) {
      $data = $this->nearByRecords($data,$state->id,$hotel->id,'Hotel');
  }

  $data['tourismZone'] = null;
  if($state) {
    $data['tourismZone'] =  $state->tourism_zones()->first();
}
        // dd($hotel);

return view('sites.pages.hotel-detail', $data);
}

public function nearByRecords($data,$state_id,$p_id,$p_type)
{
  /*near by hotel*/
  $hotelQuery = [];
  $hotelQuery = Hotel::query();
  if ($p_type == 'Hotel') {
    $hotelQuery->where('hotels.id', '!=',$p_id);
}
$hotelQuery->leftJoin('hotel_states', 'hotel_states.hotel_id', '=', 'hotels.id');
$hotelQuery->where('hotel_states.state_id', $state_id);
$hotelQuery->inRandomOrder();
$hotelQuery->limit(4);
$nearhotels=  $hotelQuery->get();
$data['nearByHotel'] = $nearhotels;
/*near by tour*/
$tourQuery = [];
$tourQuery = Tour::query();
if ($p_type == 'Tour') {
    $tourQuery->where('tours.id', '!=',$p_id);
}
$tourQuery->leftJoin('tour_states', 'tour_states.tour_id', '=', 'tours.id');
$tourQuery->where('tour_states.state_id', $state_id);
$tourQuery->inRandomOrder();
$tourQuery->limit(4);
$neartours=  $tourQuery->get();
$data['nearByTour'] = $neartours;
/*near by activity*/
$activityQuery = [];
$activityQuery = Activity::query();
if ($p_type == 'Activity') {
    $activityQuery->where('activities.id', '!=',$p_id);
}
$activityQuery->leftJoin('activity_states', 'activity_states.activity_id', '=', 'activities.id');
$activityQuery->where('activity_states.state_id', $state_id);
$activityQuery->inRandomOrder();
$activityQuery->limit(4);
$nearactivity=  $activityQuery->get();
$data['nearByActivity'] = $nearactivity;
/*near by location*/
$locationQuery = [];
$locationQuery = Location::query();
if ($p_type == 'Location') {
    $locationQuery->where('locations.id', '!=',$p_id);
}
$locationQuery->leftJoin('location_states', 'location_states.location_id', '=', 'locations.id');
$locationQuery->where('location_states.state_id', $state_id);

$locationQuery->inRandomOrder();
$locationQuery->limit(4);
$nearlocations=  $locationQuery->get();
$data['nearByLocation'] = $nearlocations;
return $data;
}

public function tourDetail(Request $request, $slug) {



    $tour = Tour::with(['detail', 'types', 'other_packages', 'package_types', 'locations', 'languages', 'states'])->where('slug', $slug)->first();
    if(!$tour) {
        abort(404);
    }

    $data['tour'] = $tour;
    $data['title'] = 'Our Package :: '.ucwords($tour->name);
    $data['body_class'] = 'tour-detail-page';
    $state = $tour->states()->first();
    $data['nearByHotel'] = collect([]);
    $data['nearByTour'] =  collect([]);
    $data['nearByActivity'] =collect([]);
    $data['nearByLocation'] = collect([]);
    if (!empty($state->id)) {
      $data = $this->nearByRecords($data,$state->id,$tour->id,'Tour');
  }

  $data['countryZone'] = null;
  if($state) {
    $data['countryZone'] =  $tour->country_zone;
}

$data['tourismZone'] = null;
if($state) {
    $data['tourismZone'] =  $state->tourism_zones()->first();
}


return view('sites.pages.tour-detail', $data);

        //return view('sites.pages.tour-detail', compact('hotel', 'tourismZone'));

}

public function activityDetail(Request $request, $slug) {



    $activity = Activity::with(['activity_packages', 'attractions', 'locations', 'languages', 'term_activity_lists', 'states','detail','activity_lists'])->where('slug', $slug)->first();
    if(!$activity) {
        abort(404);
    }



    $data['activity'] = $activity;
    $data['title'] = 'Activity :: '.ucwords($activity->name);
    $data['body_class'] = 'activity-detail-page';
    $state = $activity->states()->first();

    if (!empty($state->id)) {
      $data = $this->nearByRecords($data,$state->id,$activity->id,'Activity');
  }
  $data['nearByHotel'] = collect([]);
  $data['nearByTour'] =  collect([]);
  $data['nearByActivity'] =collect([]);
  $data['nearByLocation'] = collect([]);
  $data['activity_zone'] = null;
  if (!empty($activity->detail->activity_zones)) {
     $data['activity_zone'] = $activity->activity_zone->first();
 }

 $data['custom_icons'] = null;
 $custom_icons = CustomIcon::get(['id','slug','path','uri']);
 if (!empty($custom_icons)) {
     $data['custom_icons'] = $custom_icons;
 }
 $data['tourismZone'] = null;

 if($state) {
    $data['tourismZone'] =  $state->tourism_zones->first();
}

return view('sites.pages.activity-detail', $data);

        //return view('sites.pages.tour-detail', compact('hotel', 'tourismZone'));

}
public function locationDetail(Request $request, $slug) {

    $location = Location::with(['places', 'types', 'states', 'locationMeta'])->where('slug', $slug)->first();
    if(!$location) {
        abort(404);
    }

    $data['location'] = $location;
    $data['title'] = 'Loction :: '.ucwords($location->name);
    $data['body_class'] = 'destination-detail-page';
    $state = $location->states()->first();
    $data['nearByHotel'] = collect([]);
    $data['nearByTour'] =  collect([]);
    $data['nearByActivity'] =collect([]);
    $data['nearByLocation'] = collect([]);

    if (!empty($state->id)) {
      $data = $this->nearByRecords($data,$state->id,$location->id,'Location');
  }


         // $data['activity_zone'] = null;
         // if (!empty($activity->detail->activity_zones)) {
         //     $data['activity_zone'] = $activity->activity_zone->first();
         // }

        //  $data['custom_icons'] = null;
        //  $custom_icons = CustomIcon::get(['id','slug','path','uri']);
        //  if (!empty($custom_icons)) {
        //      $data['custom_icons'] = $custom_icons;
        //  }
        //  $data['tourismZone'] = null;

        // if($state) {
        //     $data['tourismZone'] =  $state->tourism_zones->first();
        // }

  return view('sites.pages.location-detail', $data);

        //return view('sites.pages.tour-detail', compact('hotel', 'tourismZone'));

}
public function getHotels(Request $request, $view = "list") {

    if (isMobileDevice()) {
        $view = "grid";
    }
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
            // TODO: title
        $hotelQuery->where('hotels.address', 'LIKE', '%'.$searchTerm.'%');
        $hotelQuery->orWhere('hotels.name', 'LIKE', '%'.$searchTerm.'%');
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



public function getTours(Request $request, $view = "list") {

    if (isMobileDevice()) {
        $view = "grid";
    }
    $tourQuery = Tour::query();
    $tourQuery->selectRaw(' tours.*, tour_details.latitude, tour_details.longitude');

    $tourQuery->leftJoin('tour_details', 'tour_details.tour_id', '=', 'tours.id');

        // $tourQuery->leftJoin('tour_package_types', 'tour_package_types.tour_id', '=', 'tours.id');
        // $tourQuery->leftJoin('package_types', 'package_types.id', '=', 'tour_package_types.package_type_id');

    if($request->has('range') && !empty($request->get('range'))) {
        $range = explode(";", $request->get('range'));
            // TODO: Need Proper Validation
        $minimum = $range[0];
        $maximum = $range[1];

        $tourQuery->whereBetween("avg_price", [$minimum, $maximum]);
    }

    if($request->has('duration_day') && !empty($request->get('duration_day'))) {
        $duration_day = explode(";", $request->get('duration_day'));
            // TODO: Need Proper Validation
            // $minimum = $duration_day[0];
            // $maximum = $duration_day[1];

        $hotelQuery->whereIn("duration_day",$duration_day);
    }


        // Package Types
    if($request->has('package_types') && !empty($request->get('package_types'))) {
        $package_typesValue = $request->get('package_types');
        $package_types = explode(",", $package_typesValue);
            // No Need Data from package Type
        $tourQuery->leftJoin('tour_package_types', 'tour_package_types.tour_id', '=', 'tours.id');
        $tourQuery->whereIn('tour_package_types.package_type_id', $package_types);
    }

        // other_packages
    if($request->has('other_packages') && !empty($request->get('other_packages'))) {
        $other_packagesValue = $request->get('other_packages');
        $other_packages = explode(",", $other_packagesValue);
        $tourQuery->leftJoin('tour_other_packages', 'tour_other_packages.tour_id', '=', 'tours.id');
        $tourQuery->whereIn('tour_other_packages.other_package_id', $other_packages);
    }

        // types
    if($request->has('types') && !empty($request->get('types'))) {
        $typesValue = $request->get('types');
        $types = explode(",", $typesValue);
            // No Need Data from Type
        $tourQuery->leftJoin('tour_types', 'tour_types.tour_id', '=', 'tours.id');
        $tourQuery->whereIn('tour_types.type_id', $types);
    }

        // languages
    if($request->has('language') && !empty($request->get('language'))) {
        $languagesValue = $request->get('language');
        $languages = explode(",", $languagesValue);
            // No Need Data from Language
        $tourQuery->leftJoin('tour_languages', 'tour_languages.tour_id', '=', 'tours.id');
        $tourQuery->whereIn('tour_languages.language_id', $languages);
    }

        // Search Params
    if($request->has('sourceType') && !empty($request->get('sourceType')) && $request->has('sourceId') && !empty($request->get('sourceId'))) {
        $sourceType = $request->get('sourceType');
        $sourceId = $request->get('sourceId');
        if ($sourceType == "state") {
            $tourQuery->leftJoin('tour_states', 'tour_states.tour_id', '=', 'tours.id');
            $tourQuery->where('tour_states.state_id', $sourceId);
        }else {
            $tourQuery->leftJoin('tour_locations', 'tour_locations.tour_id', '=', 'tours.id');
            $tourQuery->where('tour_locations.location_id', $sourceId);
        }


    }else if($request->has('searchTerm') && !empty($request->get('searchTerm'))) {
            //search in address
        $searchTerm = $request->get('searchTerm');
            // TODO: JSON Treatment is Pending
        $tourQuery->where('tours.address', 'LIKE', '%'.$searchTerm.'%');
        $tourQuery->orWhere('tours.name', 'LIKE', '%'.$searchTerm.'%');
    }


    $pageNumber = 1;
    if($request->has('pageNo') && !empty($request->get('pageNo'))) {
        $pageNumber = $request->get('pageNo');
    }


    $tours = $tourQuery->groupBy('tours.id')->paginate(12, ['*'], 'page', $pageNumber);
        // TODO: Include Status Check
        // $tourQuery->where('status', tour::)

    return View::make('sites.partials.results.tour', ['tours' => $tours, 'view' => $view]);

}
public function getActivities(Request $request, $view = "list") {

    if (isMobileDevice()) {
        $view = "grid";
    }
            //dd($request->all());
    $activityQuery = Activity::query();
    $activityQuery->selectRaw(' activities.*, activity_details.latitude, activity_details.longitude');

    $activityQuery->leftJoin('activity_details', 'activity_details.activity_id', '=', 'activities.id');

        // $activityQuery->leftJoin('activity_package_types', 'activity_package_types.activity_id', '=', 'activities.id');
        // $activityQuery->leftJoin('package_types', 'package_types.id', '=', 'activity_package_types.package_type_id');




        // ratting
    if($request->has('rating') && !empty($request->get('rating'))) {
        $ratingValue = $request->get('rating');
        $rating = explode(",", $ratingValue);

        $activityQuery->whereIn('activities.rating', $rating);
    }

        // Term Activity List
    if($request->has('term_activity_lists') && !empty($request->get('term_activity_lists'))) {
        $term_activity_listsValue = $request->get('term_activity_lists');
        $term_activity_lists = explode(",", $term_activity_listsValue);
            // No Need Data from package Type
        $activityQuery->leftJoin('activity_term_activity_lists', 'activity_term_activity_lists.activity_id', '=', 'activities.id');
        $activityQuery->whereIn('activity_term_activity_lists.term_activity_lists_id', $term_activity_lists);
    }



        // activity_package_list
    if($request->has('activity_package_list') && !empty($request->get('activity_package_list'))) {
            //$activity_package_listValue = $request->get('activity_package_list');
            //$activity_package_lists = explode(",", $activity_package_listValue);
        $activityQuery->leftJoin('activity_lists_activities', 'activity_lists_activities.activity_id', '=', 'activities.id');
    }

        // types
        // if($request->has('types') && !empty($request->get('types'))) {
        //     $typesValue = $request->get('types');
        //     $types = explode(",", $typesValue);
        //     // No Need Data from Type
        //     $activityQuery->leftJoin('activity_types', 'activity_types.activity_id', '=', 'activities.id');
        //     $activityQuery->whereIn('activity_types.type_id', $types);
        // }

        // languages
        // if($request->has('language') && !empty($request->get('language'))) {
        //     $languagesValue = $request->get('language');
        //     $languages = explode(",", $languagesValue);
        //     // No Need Data from Language
        //     $activityQuery->leftJoin('activity_languages', 'activity_languages.activity_id', '=', 'activities.id');
        //     $activityQuery->whereIn('activity_languages.language_id', $languages);
        // }

        // Search Params
    if($request->has('sourceType') && !empty($request->get('sourceType')) && $request->has('sourceId') && !empty($request->get('sourceId'))) {
        $sourceType = $request->get('sourceType');
        $sourceId = $request->get('sourceId');
        if ($sourceType == "state") {
            $activityQuery->leftJoin('activity_states', 'activity_states.activity_id', '=', 'activities.id');
            $activityQuery->where('activity_states.state_id', $sourceId);
        }else {
            $activityQuery->leftJoin('activity_locations', 'activity_locations.activity_id', '=', 'activities.id');
            $activityQuery->where('activity_locations.location_id', $sourceId);
        }


    }else if($request->has('searchTerm') && !empty($request->get('searchTerm'))) {
            //search in address
        $searchTerm = $request->get('searchTerm');
            // TODO: JSON Treatment is Pending
        $activityQuery->where('activities.address', 'LIKE', '%'.$searchTerm.'%');
        $activityQuery->orWhere('activities.name', 'LIKE', '%'.$searchTerm.'%');
    }


    $pageNumber = 1;
    if($request->has('pageNo') && !empty($request->get('pageNo'))) {
        $pageNumber = $request->get('pageNo');
    }


    $activities = $activityQuery->groupBy('activities.id')->paginate(12, ['*'], 'page', $pageNumber);
        // TODO: Include Status Check
        // $activityQuery->where('status', activity::)

    return View::make('sites.partials.results.activity', ['activities' => $activities, 'view' => $view]);

}

/*get location*/

public function getLocations(Request $request, $view = "grid")
{
    $view = "grid";
    $locationQuery = location::query();
    $locationQuery->selectRaw(' locations.*');

        // Search Params
    if($request->has('sourceType') && !empty($request->get('sourceType')) && $request->has('sourceId') && !empty($request->get('sourceId'))) {
        $sourceType = $request->get('sourceType');
        $sourceId = $request->get('sourceId');
        if ($sourceType == "state") {
            $locationQuery->leftJoin('location_states', 'location_states.location_id', '=', 'locations.id');
            $locationQuery->where('location_states.state_id', $sourceId);
        }else {
                // $locationQuery->leftJoin('locations', 'location_locations.location_id', '=', 'locations.id');
            $locationQuery->where('locations.id', $sourceId);
        }


    }else if($request->has('searchTerm') && !empty($request->get('searchTerm'))) {
            //search in address
        $searchTerm = $request->get('searchTerm');
            // TODO: JSON Treatment is Pending
        $locationQuery->where('locations.address', 'LIKE', '%'.$searchTerm.'%');
        $locationQuery->orWhere('locations.name', 'LIKE', '%'.$searchTerm.'%');
    }


    $pageNumber = 1;
    if($request->has('pageNo') && !empty($request->get('pageNo'))) {
        $pageNumber = $request->get('pageNo');
    }


    $locations = $locationQuery->groupBy('locations.id')->paginate(12, ['*'], 'page', $pageNumber);
        // TODO: Include Status Check
        // $locationQuery->where('status', location::)

    return View::make('sites.partials.results.location', ['locations' => $locations, 'view' => $view]);

}

public function locationDetailFetch(Request $request,$view)
{
  $id = $request->location_id;
  $location = Location::findOrFail($id);
  if ($view == 'tourism-zone') {
   $state = $location->states()->first();
   if($state) {
    $tourismZone =  $state->tourism_zones->first();
}
return View::make('sites.partials.location-details.'.$view,['tourismZone'=>$tourismZone]);
}else{
  return View::make('sites.partials.location-details.'.$view, ['location' => $location]);
}   
}


public function inquiry(Request $request)
{
        // $data['data'] = [];
    $data['msg'] = 'Inquiry Form Submited Successfully';
    return response()->json($data, 200);
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
