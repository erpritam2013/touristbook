<?php

namespace App\Http\Controllers;

use App\Interfaces\AmenityRepositoryInterface;
use App\Interfaces\DealsDiscountRepositoryInterface;
use App\Interfaces\MedicareAssistanceRepositoryInterface;
use App\Interfaces\MeetingAndEventRepositoryInterface;
use App\Interfaces\PropertyTypeRepositoryInterface;
use App\Interfaces\TermActivityRepositoryInterface;
use App\Interfaces\PageRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Models\Hotel;
use App\Models\Page;
use App\Models\Tour;
use App\Models\Post;
use App\Models\Setting;
use App\Models\VideoGallery;
use App\Models\Location;
use App\Models\CustomIcon;
use App\Models\Activity;
use App\Models\Terms\Category;
use App\Models\Terms\Tag;
use App\Models\Terms\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\DataTables\PageDataTable;
use App\DataTables\TrashedPageDataTable;
use Cviebrock\EloquentSluggable\Services\SlugService;
use DB;
use Auth;
use App;
class PagesController extends Controller
{

 private PageRepositoryInterface $pageRepository;
 private PostRepositoryInterface $postRepository;


 public function __construct(
    PageRepositoryInterface $pageRepository,
    PostRepositoryInterface $postRepository,

)
 {
    $this->pageRepository = $pageRepository;
    $this->postRepository = $postRepository;
}
public function index() {
 $data['post_type'] = 'Home';
 $data['title'] = 'Home';
 $data['body_class'] = 'home-page';
 

 $page_id = Setting::get_setting('home_page');

 $page = Page::find($page_id);
 if ($page) {
    $data['page'] = $page;
}

$data = $this->home_page_content($data,$page);
return view('sites.pages.home',$data);
}
public function home_page_content($data,$page_data)
{     
  if(!empty($page_data)){
      $existed_hotels = $page_data->extra_data['hotels'] ?? [];
      $existed_tours = $page_data->extra_data['tours'] ?? [];
      $existed_locations = $page_data->extra_data['locations'] ?? [];
      $existed_activities = $page_data->extra_data['activities'] ?? [];
      $existed_blogs = $page_data->extra_data['blogs'] ?? [];

  }

  $locations = Location::query();
  $hotels = Hotel::query();
  $activities = Activity::query();
  $tours = Tour::query();
  $posts = Post::query();

  if (isset($existed_hotels) && !empty($existed_hotels)) {
   $hotels->whereIn('id',$existed_hotels);
}else{
   $hotels->latest();
}

if (isset($existed_tours) && !empty($existed_tours)) {
  $tours->whereIn('id',$existed_tours);
}else{
   $tours->latest();
}
if (isset($existed_locations) && !empty($existed_locations)) {
 $locations->whereIn('id',$existed_locations);
}else{
   $locations->latest();
}
if (isset($existed_blogs) && !empty($existed_blogs)) {
   $posts->whereIn('id',$existed_blogs);
}else{
   $posts->latest();
}

if (isset($existed_activities) && !empty($existed_activities)) {
   $activities->whereIn('id',$existed_activities);
}else{
   $activities->latest();
}

$data['home_hotels'] = $hotels->limit(6)->get(['id','name','slug','featured_image','avg_price','address']);
$data['home_activities'] = $activities->limit(6)->get(['id','name','slug','featured_image','price']);
$data['home_tours'] = $tours->limit(6)->get(['id','name','slug','featured_image','price']);
$data['home_posts'] = $posts->limit(6)->get(['id','name','slug','featured_image','excerpt','description']);
$data['home_destinations'] =$locations->latest()->limit(5)->get(['id','name','slug','featured_image']);

return $data;
}


public function pages(PageDataTable $dataTable)
{
    $pages = $this->pageRepository->getAllPages();
    $data = [
        'title'     => 'Pages',
        'pages'     => $pages->count(),
        'trashed' => Page::onlyTrashed()->count()
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
    $page_id = Setting::get_setting('hotel_list_page');
    
    $page = Page::find($page_id);
    if ($page) {
        $data['page'] = $page;
    }
    return view('sites.pages.hotels',$data);
}
public function about() {
    $data['post_type'] = 'About';
    $data['title'] = 'About';
    $page_id = Setting::get_setting('about_page');
    
    $page = Page::find($page_id);
    if ($page) {
        $data['page'] = $page;
    }
    $data['body_class'] = 'about-page';

    return view('sites.pages.about',$data);
}
public function connecting_partners() {
    $data['post_type'] = 'connecting_partners';
    $data['title'] = 'Connecting Partners';
    $data['body_class'] = 'connecting-partners-page';

    $page_id = Setting::get_setting('connecting_partner_page');
    
    $page = Page::find($page_id);
    if ($page) {
        $data['page'] = $page;
    }
    return view('sites.pages.connecting-partners',$data);
}

public function language_update(Request $request)
{
    App::setLocale($request->lang);
    Session::put('locale',$request->lang);
    Session::put('languageText',$request->languageText);
    Session::put('img_src',$request->img_src);

    return response()->json(['message' => 'Change Language successfully', 'success' => true]);
}

public function blogs(Request $request,$term='',$slug='') {

    $data['post_type'] = 'Blog';
    $data['title'] = 'Blogs';
    $data['body_class'] = 'blog-page';
    if ($term == 'category') {
        $data['category'] = $slug;
    }
    if ($term == 'tag') {
        $data['tag'] = $slug;
    }

    $page_id = Setting::get_setting('post_list_page');
    
    $page = Page::find($page_id);
    if ($page) {
        $data['page'] = $page;
    }

    $data['sourceType'] = $request->get('source_type');
    return view('sites.pages.blogs',$data);
}
public function destinations(Request $request) {

    $data['post_type'] = 'Location';
    $data['title'] = 'Destinations';
    $data['body_class'] = 'destinations-page';
    $data['searchTerm'] = $request->get('search');
    $data['sourceType'] = $request->get('source_type');
    $data['sourceId'] = $request->get('source_id');
    $page_id = Setting::get_setting('location_list_page');
    
    $page = Page::find($page_id);
    if ($page) {
        $data['page'] = $page;
    }
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
    $data = [];
    if (isset($request->id)) {
        $id = $request->id;
        $view_purify = purify_string($view,'ucwords');
        $page = $this->pageRepository->getPageByType($id,$view_purify);

        if (!empty($page)) {
            $data['page'] = $page;
        }
    }


    if ($view == 'home') {
        $category = Category::where('slug','blog')->first();
        $data['hotels'] = Hotel::where('status',1)->get(['id','name'])->map(function($item, $key){

           return (object)[
            'id' => $item->id,
            'value' => $item->name,
        ];
    });
        $data['blogs'] = $category->posts()->get()->map(function($item, $key){

           return (object)[
            'id' => $item->id,
            'value' => $item->name,
        ];
    });
        $data['tours'] = Tour::where('status',1)->get(['id','name'])->map(function($item, $key){

           return (object)[
            'id' => $item->id,
            'value' => $item->name,
        ];
    });
        $data['locations'] = Location::where('status',1)->get(['id','name'])->map(function($item, $key){

           return (object)[
            'id' => $item->id,
            'value' => $item->name,
        ];
    });
        $data['activities'] = Activity::where('status',1)->get(['id','name'])->map(function($item, $key){

           return (object)[
            'id' => $item->id,
            'value' => $item->name,
        ];
    });
    }

    return View::make('admin.pages.page_templates.'.$view,$data);
}
public function our_packages(Request $request) {

    $data['post_type'] = 'Tour';
    $data['title'] = 'Our Packages';
    $data['body_class'] = 'tour-list-page';
    $data['searchTerm'] = $request->get('search');
    $data['sourceType'] = $request->get('source_type');
    $data['sourceId'] = $request->get('source_id');
    $page_id = Setting::get_setting('tour_list_page');
    
    $page = Page::find($page_id);
    if ($page) {
        $data['page'] = $page;
    }

    return view('sites.pages.our-packages', $data);
}
public function contact() {

    $data['post_type'] = 'Contact';
    $data['title'] = 'Contact Us';
    $data['body_class'] = 'contact-us-page';
    $page_id = Setting::get_setting('contact_page');
    
    $page = Page::find($page_id);
    if ($page) {
        $data['page'] = $page;
    }
    return view('sites.pages.contact',$data);
}

public function send_contact(Request $request)
{
 Session::flash('success','Contact Form Send Successfully');
 redirect()->back();
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
$page_id = Setting::get_setting('hotel_detail_list_page');
$page = Page::find($page_id);
if ($page) {
    $data['page'] = $page;
}


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
$nearhotels =  $hotelQuery->get();
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
$neartours =  $tourQuery->get();
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
$nearactivity =  $activityQuery->get();
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
public function postDetail(Request $request, $slug) {



    $post = Post::with(['category'])->where('slug', $slug)->first();
    if(!$post) {
        abort(404);
    }

    $data['post'] = $post;
    $data['title'] = ucwords($post->name).' :: '.ucwords($post->name);
    $data['body_class'] = 'post-detail-page';
    $postQuery = Post::query();
    $postQuery->leftJoin('post_categories','post_categories.post_id', '=', 'posts.id');
    $postQuery->where('status',1);
    $postQuery->inRandomOrder();
    $postQuery->limit(4);
    $data['related_posts'] = $postQuery->get();
    $data['related_tags'] = Tag::latest()->limit(12)->get();
    
    $data['previous'] = Post::where('id', '<', $post->id)->max('slug');
    $data['next'] = Post::where('id', '>', $post->id)->min('slug');

    return view('sites.pages.post-detail', $data);

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

public function getposts(Request $request, $term = "",$slug = "",$view = "grid") {


    $view = "grid";
    $title = 'Blogs';
    if (!empty($slug)) {
     $title = purify_string($slug,'ucwords');
 }

 $postQuery = Post::query();
 $postQuery->selectRaw(' posts.*');


 if (!empty($term) && $term == 'category') {

   $category = Category::where('slug',$slug)->first();
   $category_id = !empty($category)?$category->id:0;
   $postQuery->join('post_categories','posts.id','=','post_categories.post_id');
   $postQuery->where('post_categories.category_id',$category_id);
}elseif (!empty($term) && $term == 'tag') {
   $tag = Tag::where('slug',$slug)->first();
   $tag_id = !empty($tag)?$tag->id:0;
   $postQuery->join('post_tags','posts.id','=','post_tags.post_id');
   $postQuery->where('post_tags.tag_id',$tag_id);
}
        // category
if($request->has('category') && !empty($request->get('category'))) {
    $categoryValue = $request->get('category');
    $category = $categoryValue;
    $postQuery->where('post_categories.category_id', $category);
}



        // Search Params
if($request->has('sourceType') && !empty($request->get('sourceType'))) {
            //search in address
    $sourceType = $request->get('sourceType');
            // TODO: JSON Treatment is Pending
            // TODO: title
    $postQuery->where('posts.name', 'LIKE', '%'.$sourceType.'%');
}


$pageNumber = 1;
if($request->has('pageNo') && !empty($request->get('pageNo'))) {
    $pageNumber = $request->get('pageNo');
}


$posts = $postQuery->groupBy('posts.id')->paginate(12, ['*'], 'page', $pageNumber);

        // TODO: Include Status Check
        // $postQuery->where('status', post::)

return View::make('sites.partials.results.blog', ['posts' => $posts, 'view' => $view,'title'=>$title]);

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

        $tourQuery->whereBetween("price", [$minimum, $maximum]);
    }

    if($request->has('duration_day') && !empty($request->get('duration_day'))) {
        $duration_day = $request->get('duration_day');
            // TODO: Need Proper Validation

            // $minimum = $duration_day[0];
            // $maximum = $duration_day[1];
        $tourQuery->where("duration_day","like",'%'.$duration_day.'%');

        
        
    }



        // Package Types
    if($request->has('package_types') && !empty($request->get('package_types'))) {
        $package_typesValue = $request->get('package_types');
        $package_types = explode(",", $package_typesValue);
            // No Need Data from package Type
        $tourQuery->leftJoin('tour_package_types', 'tour_package_types.tour_id', '=', 'tours.id');
        $tourQuery->whereIn('tour_package_types.package_type_id', $package_types);
    }


      //$tourQuery->toSql();
        // other_packages


    if($request->has('other_packages') && !empty($request->get('other_packages'))) {
        $other_packagesValue = $request->get('other_packages');
        $other_packages = explode(",", $other_packagesValue);
        $tourQuery->leftJoin('tour_other_packages', 'tour_other_packages.tour_id', '=', 'tours.id');
        $tourQuery->whereIn('tour_other_packages.other_package_id', $other_packages);
    }else{
      if($request->has('other_package_parent') && !empty($request->get('other_package_parent'))) {
        $other_package_parentValue = $request->get('other_package_parent');
        //$other_packages = explode(",", $other_packagesValue);
        $tourQuery->leftJoin('tour_other_packages', 'tour_other_packages.tour_id', '=', 'tours.id');
        $tourQuery->where('tour_other_packages.other_package_id', $other_package_parentValue);
    } 
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
public function set_extra_data_of_page($request)
{
    $extra_data = [];
    if (isset($request->extra_data)) {
        $extra_data = $request->extra_data;
    }
    if (isset($request->type) && !empty($request->type)) {
        if ($request->type == 'About') {

          $extra_data['about_info'] = $request->about_info;
          $extra_data['about_team'] = $request->about_team;
      }
      if ($request->type == 'Tour') {
        $extra_data = $request->extra_data;
    }
    if ($request->type == 'Connecting Partner') {
       $extra_data['connecting_partners'] = $request->connecting_partners;
   }

}
$extra_data["page_sidebar_pos"] = $request->page_sidebar_pos;
$extra_data["page_sidebar"] = $request->page_sidebar;
$extra_data["social_links"] = $request->social_links;

return $extra_data;
}
function store(Request $request,)
{

 $request->merge([
    'extra_data' => $this->set_extra_data_of_page($request),
]);

 $request->merge([
    'featured_image' => json_decode($request->featured_image,true),
]);


 $pageDetails = [
    'name' =>  ucwords($request->name),
    'slug' => SlugService::createSlug(Page::class, 'slug', $request->name),
    'description' => $request->description,
    "gallery" => $request->gallery,
    "media" => $request->media,
    "link" => $request->link,
    "extra_data" => $request->extra_data,
    "excerpt" => $request->excerpt,
    "status" => $request->status,
    "featured_image" => $request->featured_image,
    "type" => $request->type,
    "created_by"=> Auth::user()->id,
];

$this->pageRepository->createPage($pageDetails);
Session::flash('success','Page Created Successfully');
return redirect()->Route('admin.pages.pageIndex');
}

public function edit(Page $page)
{
    // $page = $this->pageRepository->getPageById($id);

    if (empty($page)) {
        return back();
    }
    
    $data['title'] = 'Page Edit';
    $data['page'] = $page;
        //$data = array_merge_recursive($data, $this->_prepareBasicData());
    return view('admin.pages.edit', $data);
}



function update(Request $request,Page $page)
{

  if (empty($page)) {
     abort(404);
 }

 $request->merge([
    'extra_data' => $this->set_extra_data_of_page($request),
]);


 $pageDetails = [
    'name' => ucwords($request->name),
    //'slug' => SlugService::createSlug(Page::class, 'slug', $request->name),
    'description' => $request->description,
    "gallery" => $request->gallery,
    "media" => $request->media,
    "link" => $request->link,
    "extra_data" => $request->extra_data,
    "excerpt" => $request->excerpt,
    "status" => $request->status,
    "featured_image" => $request->featured_image,
    "type" => $request->type,
    "created_by"=> Auth::user()->id,
];


$this->pageRepository->updatePage($page->id,$pageDetails);
Session::flash('success','Page Updated Successfully');
return redirect()->Route('admin.pages.edit',$page->id);
}
public function changeStatus(Request $request)
{
    $pageId = $request->id;
    $pageDetails = [
        'status' => $request->status,
    ];
    $this->pageRepository->updatePage($pageId, $pageDetails);
    
    return response()->json(['success'=>'Status change successfully.']);
}


public function destroy(Page $page)
{
 $pageId = $page->id;
 $this->pageRepository->deletePage($pageId);
 Session::flash('success','Page Deleted Successfully');
 return back();
}

  /**
     * Remove the specified all resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */

  public function bulk_delete(Request $request)
  {

     if (!empty($request->ids)) {

        $pageIds = get_array_mapping(json_decode($request->ids));

        $this->pageRepository->deleteBulkPage($pageIds);
        Session::flash('success','Page Bulk Deleted Successfully');
    }
    return back();
}


public function trashed_pages(TrashedPageDataTable $dataTable)
    {

        $trashed_pages = Page::onlyTrashed()->get();
        $data['trashed_count'] = $trashed_pages->count();
        //$data['trashed_pages'] = $trashed_pages;
        $data['title'] = 'Trash Page List';
        // dump(Page::onlyTrashed()->get());
        // dd( $data['trashed']);
        return $dataTable->render('admin.Pages.trashed', $data);
    }

    public function restore_pages(Request $request)
    {
        $ids = [];
        if (!empty($request->ids)) {
           $ids =  get_array_mapping(json_decode($request->ids));

        }
      
        if (!empty($ids)) {
         Page::whereIn('id',$ids)->withTrashed()->restore();
        }else{
           Page::onlyTrashed()->restore();
        }
        Session::flash('success','Page Restored Successfully');
         return redirect()->back();
    }

    public function restore_page(Request $request,$id)
    {
        $page = Page::withTrashed()->find($id);
    if ($page == null)
    {
        abort(404);
    }
 
    $page->restore();
     Session::flash('success','Page Restored Successfully');
    return redirect()->back();
    }
  public function bulk_force_delete(Request $request)
    {

    
        if (!empty($request->fd_ids)) {

            $pageIds = get_array_mapping(json_decode($request->fd_ids));
            $this->pageRepository->forceBulkDeletePage($pageIds);
            Session::flash('success', 'Page Bulk Permanent Deleted Successfully');
        }
        return back();
    }

    public function permanent_delete($id)
{
    $this->pageRepository->forceDeletePage($id);
    Session::flash('success','Page Permanent Deleted Successfully');
    return back();
}

  public function empty_trashed(Request $request)
    {

        Page::onlyTrashed()->forceDelete();
        Session::flash('success','Page Empty Trashed Successfully');
       return redirect()->back();
    }

}
