<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\MedicareAssistanceController;
use App\Http\Controllers\TopServiceController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\AccessibleController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\PackageTypeController;
use App\Http\Controllers\MeetingAndEventController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\OccupancyController;
use App\Http\Controllers\DealsDiscountController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\TermActivityController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UtilityController;
use App\Http\Controllers\CountryZoneController;
use App\Http\Controllers\ActivityZoneController;
use App\Http\Controllers\ActivityListsController;
use App\Http\Controllers\ActivityPackageController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\TermActivityListController;
use App\Http\Controllers\AttractionController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\TourismZoneController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConversionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\OtherPackageController;
use App\Http\Controllers\TourController;

use App\Http\Controllers\CustomIconController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RegisterController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoGalleryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SettingController;
use App\Models\Conversion;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/updateCurrency', function (\Illuminate\Http\Request $request) {
    $currency = $request->input('currency');


    $conversion = Conversion::where('currency_name', $currency)->first();
    if($conversion){
        Session::put('country_code', $conversion->country_code);
        Session::put('currency', $currency);
        Session::put('currency_symbol', $conversion->currency_symbol);
    }

    return response()->json(['message' => 'Session updated successfully', 'success' => true]);
});

Route::post('/updateLanguage', function (\Illuminate\Http\Request $request) {

        Session::put('locale',$request->lang);
        Session::put('languageText',$request->languageText);
        Session::put('img_src',$request->img_src);

    return response()->json(['message' => 'Change Language successfully', 'success' => true]);
})->name('updateLanguage');



Route::get('/', [PagesController::class, 'index'])->name('home');

Route::get('/hotels', [PagesController::class, 'hotels'])->name('hotels');
Route::get('/about', [PagesController::class, 'about'])->name('about');
Route::post('/wishlist-add/', [UserController::class, 'wishlist_add'])->name('wishlist-add');
Route::post('//wishlist-remove/', [UserController::class, 'wishlist_remove'])->name('/wishlist-remove');
Route::get('/wishlists/', [PagesController::class, 'wishlists'])->name('wishlists');
Route::get('/blogs', [PagesController::class, 'blogs'])->name('blogs');
Route::get('/blogs/{term}/{category}', [PagesController::class, 'blogs'])->name('category-blogs');
Route::get('/blogs/{term}/{tag}', [PagesController::class, 'blogs'])->name('tag-blogs');
Route::post('/inquiry', [PagesController::class, 'inquiry'])->name('inquiry');
Route::get('/destinations', [PagesController::class, 'destinations'])->name('destinations');
Route::get('/activities', [PagesController::class, 'activities'])->name('activities');
Route::get('/our-packages', [PagesController::class, 'our_packages'])->name('our-packages');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
// Route::post('/contact', [PagesController::class, 'send_contact'])->name('send-contact');
Route::post('/contact', [ContactController::class, 'store'])->name('store');
Route::get('/connecting-partners', [PagesController::class, 'connecting_partners'])->name('connecting-partners');

Route::get('/st_hotel/{slug}', [PagesController::class, 'hotelDetail'])->name('hotel');
Route::get('/st_tour/{slug}', [PagesController::class, 'tourDetail'])->name('tour');
Route::get('/blog/{slug}', [PagesController::class, 'postDetail'])->name('blog');
Route::get('/st_activity/{slug}', [PagesController::class, 'activityDetail'])->name('activity');
Route::get('/st_location/{slug}', [PagesController::class, 'locationDetail'])->name('location');
Route::get('/location-detail-fetch/{view}', [PagesController::class, 'locationDetailFetch'])->name('locationDetailFetch');


Route::get('/term-conditions', [PagesController::class, 'termConditions'])->name('term-conditions');
Route::get('/get-hotels/{view}', [PagesController::class, 'getHotels'])->name('get-hotels');
Route::get('/get-posts/{view}', [PagesController::class, 'getPosts'])->name('get-posts');
Route::get('/get-posts/{term}/{tag}/{view}', [PagesController::class, 'getPosts'])->name('term-tag-get-posts');
Route::get('/get-posts/{term}/{category}/{view}', [PagesController::class, 'getPosts'])->name('term-category-get-posts');
Route::get('/get-tours/{view}', [PagesController::class, 'getTours'])->name('get-tours');
Route::get('/get-activities/{view}', [PagesController::class, 'getActivities'])->name('get-activities');
Route::get('/get-locations/{view}', [PagesController::class, 'getLocations'])->name('get-locations');
Route::get('/get-location-states', [PagesController::class, 'getLocationState'])->name('get-location-state');

 


Route::get('/ajax/login-status', [LoginController::class, 'getLoginStatus'])->name('login-status');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login-post', [LoginController::class, 'authenticate'])->name('login-post');

Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register-post', [RegisterController::class, 'store'])->name('register-post');


Route::get('load-comments',[CommentController::class,'loadComment'])->name('load-comments');
Route::post('review-store',[CommentController::class,'commentStore'])->name('review-store');


Route::name('admin.')->prefix('admin')->middleware(['auth'])->group(function () {

    Route::get('profile',[AdminController::class,'profile'])->name('profile');

    Route::post('ajax-term-store',[UtilityController::class,'ajax_term_store'])->name('ajax-term-store');

    Route::get('template/{type}', [UtilityController::class, 'get_template_by_type'])->name('template');

    Route::name('files.')->prefix('files')->group(function() {
        Route::get('load-images', [FileController::class, 'loadImages'])->name('load');
        Route::post('upload', [FileController::class, 'uploadImages'])->name('upload');
    });
    /*Comments Routes*/
    Route::name('comments.')->prefix('comments')->group(function() {
       
       Route::get('/', [CommentController::class, 'index'])->name('index');
       Route::get('show/{id}', [CommentController::class, 'show'])->name('show');
        Route::delete('/{id}', [CommentController::class,'destroy'])->name('destroy');
         Route::delete('comment/bulk-delete', [CommentController::class,'bulk_delete'])->name('bulk-delete');
    });

    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    /*terms grouping*/
    Route::name('terms.')->prefix('terms')->group(function () {
     /*Terms Route*/
     Route::get('/', [AdminController::class, 'terms']);

    /*Facility Routes*/
    Route::resource('facilities', FacilityController::class);
    Route::delete('facility/bulk-delete', [FacilityController::class,'bulk_delete'])->name('facilities.bulk-delete');
    Route::get('facility/ajax-get', [FacilityController::class,'getFacilitiesAjax'])->name('ajaxGet');
    Route::get('facility/changeStatus', [FacilityController::class,'changeStatus'])->name('changeStatus');

    /*Attraction Routes*/
    Route::resource('attractions', AttractionController::class);
    Route::delete('attraction/bulk-delete', [AttractionController::class,'bulk_delete'])->name('attractions.bulk-delete');
    Route::get('attraction/ajax-get', [AttractionController::class,'getAttractionsAjax'])->name('ajaxGetAttraction');
    Route::get('attraction/changeStatus', [AttractionController::class,'changeStatus'])->name('changeStatusAttraction');

    /*Amenities Routes*/
    Route::resource('amenities', AmenityController::class);
        Route::delete('amenity/bulk-delete', [AmenityController::class,'bulk_delete'])->name('amenities.bulk-delete');
    Route::get('amenity/ajax-get', [AmenityController::class,'getAmenitiesAjax'])->name('ajaxGetAmenity');
    Route::get('amenity/changeStatus', [AmenityController::class,'changeStatus'])->name('changeStatusAmenity');
    /*Categories Routes*/
    Route::resource('categories', CategoryController::class);
        Route::delete('category/bulk-delete', [CategoryController::class,'bulk_delete'])->name('categories.bulk-delete');
    Route::get('category/ajax-get', [CategoryController::class,'getCategoriesAjax'])->name('ajaxGetCategory');
    Route::get('category/changeStatus', [CategoryController::class,'changeStatus'])->name('changeStatusCategory');
    /*Tags Routes*/
    Route::resource('tags', TagController::class);
        Route::delete('tag/bulk-delete', [TagController::class,'bulk_delete'])->name('tags.bulk-delete');
    Route::get('tag/changeStatus', [TagController::class,'changeStatus'])->name('changeStatusTag');

    /*Medicare Assistance Routes*/
    Route::resource('medicare-assistances', MedicareAssistanceController::class);
    Route::delete('medicare-assistance/bulk-delete', [MedicareAssistanceController::class,'bulk_delete'])->name('medicare-assistances.bulk-delete');
    Route::get('medicare-assistance/ajax-get', [MedicareAssistanceController::class,'getMedicareAssistancesAjax'])->name('ajaxGetMedicareAssistance');
    Route::get('medicare-assistance/changeStatus', [MedicareAssistanceController::class,'changeStatus'])->name('changeStatusMedicareAssistance');
    /*Top Services Routes*/
    Route::resource('top-services', TopServiceController::class);
     Route::delete('top-service/bulk-delete', [TopServiceController::class,'bulk_delete'])->name('top-services.bulk-delete');
    Route::get('top-service/ajax-get', [TopServiceController::class,'getTopServicesAjax'])->name('ajaxGetTopService');
    Route::get('top-service/changeStatus', [TopServiceController::class,'changeStatus'])->name('changeStatusTopService');
    /*Places Routes*/
    Route::resource('places', PlaceController::class);
     Route::delete('place/bulk-delete', [PlaceController::class,'bulk_delete'])->name('places.bulk-delete');
    Route::get('place/ajax-get', [PlaceController::class,'getPlacesAjax'])->name('ajaxGetPlace');
    Route::get('place/changeStatus', [PlaceController::class,'changeStatus'])->name('changeStatusPlace');
    /*Accessibles Routes*/
    Route::resource('accessibles', AccessibleController::class);
     Route::delete('accessible/bulk-delete', [AccessibleController::class,'bulk_delete'])->name('accessibles.bulk-delete');
    Route::get('accessible/ajax-get', [AccessibleController::class,'getAccessiblesAjax'])->name('ajaxGetAccessible');
    Route::get('accessible/changeStatus', [AccessibleController::class,'changeStatus'])->name('changeStatusAccessible');
    /*languages Routes*/
    Route::resource('languages', LanguageController::class);
     Route::delete('language/bulk-delete', [LanguageController::class,'bulk_delete'])->name('languages.bulk-delete');
    Route::get('language/ajax-get', [LanguageController::class,'getlanguagesAjax'])->name('ajaxGetlanguage');
    Route::get('language/changeStatus', [LanguageController::class,'changeStatus'])->name('changeStatusLanguage');

    /*Property Type Routes*/
    Route::resource('property-types', PropertyTypeController::class);
     Route::delete('property-type/bulk-delete', [PropertyTypeController::class,'bulk_delete'])->name('property-types.bulk-delete');
    Route::get('property-type/ajax-get', [PropertyTypeController::class,'getPropertyTypesAjax'])->name('ajaxGetPropertyType');
    Route::get('property-type/changeStatus', [PropertyTypeController::class,'changeStatus'])->name('changeStatusPropertyType');

    /*package Type Routes*/
    Route::resource('package-types', PackageTypeController::class);
     Route::delete('package-type/bulk-delete', [PackageTypeController::class,'bulk_delete'])->name('package-types.bulk-delete');
    Route::get('package-type/ajax-get', [PackageTypeController::class,'getPackageTypesAjax'])->name('ajaxGetPackageType');
    Route::get('package-type/changeStatus', [PackageTypeController::class,'changeStatus'])->name('changeStatusPackageType');
    /*Other Package Routes*/
    Route::resource('other-packages', OtherPackageController::class);
     Route::delete('other-packages/bulk-delete', [OtherPackageController::class,'bulk_delete'])->name('other-packages.bulk-delete');
    Route::get('other-package/ajax-get', [OtherPackageController::class,'getOtherPackagesAjax'])->name('ajaxGetPackage');
    Route::get('other-package/changeStatus', [OtherPackageController::class,'changeStatus'])->name('changeStatusOtherPackage');
    /*meeting and events Routes*/
    Route::resource('meeting-and-events', MeetingAndEventController::class);
    Route::delete('meeting-and-event/bulk-delete', [MeetingAndEventController::class,'bulk_delete'])->name('meeting-and-events.bulk-delete');
    Route::get('meeting-and-event/ajax-get', [MeetingAndEventController::class,'getMeetingAndEventsAjax'])->name('ajaxGetMeetingAndEvent');
    Route::get('meeting-and-event/changeStatus', [MeetingAndEventController::class,'changeStatus'])->name('changeStatusMeetingAndEvent');
    /*occupancy Routes*/
    Route::resource('occupancies', OccupancyController::class);
    Route::delete('occupancy/bulk-delete', [OccupancyController::class,'bulk_delete'])->name('occupancies.bulk-delete');
    Route::get('occupancy/ajax-get', [OccupancyController::class,'getOccupanciesAjax'])->name('ajaxGetOccupancy');
    Route::get('occupancy/changeStatus', [OccupancyController::class,'changeStatus'])->name('changeStatusOccupancy');
    /*Deals Discount Routes*/
    Route::resource('deal-discounts', DealsDiscountController::class);
    Route::delete('deal-discount/bulk-delete', [DealsDiscountController::class,'bulk_delete'])->name('deal-discounts.bulk-delete');
    Route::get('deal-discount/ajax-get', [DealsDiscountController::class,'getDealsDiscountAjax'])->name('ajaxGetDealsDiscount');
    Route::get('deal-discount/changeStatus', [DealsDiscountController::class,'changeStatus'])->name('changeStatusDealsDiscount');
    /*Term Activity Routes*/
    Route::resource('term-activities', TermActivityController::class);
    Route::delete('term-activity/bulk-delete', [TermActivityController::class,'bulk_delete'])->name('term-activities.bulk-delete');
    Route::get('term-activity/ajax-get', [TermActivityController::class,'getTermActivitiesAjax'])->name('ajaxGetTermActivity');
    Route::get('term-activity/changeStatus', [TermActivityController::class,'changeStatus'])->name('changeStatusTermActivity');
  /*Term Activity List Routes*/
    Route::resource('term-activity-lists', TermActivityListController::class);
    Route::delete('term-activity-list/bulk-delete', [TermActivityListController::class,'bulk_delete'])->name('term-activity-lists.bulk-delete');
    Route::get('term-activity-list/ajax-get', [TermActivityListController::class,'getTermActivitiesAjax'])->name('ajaxGetTermActivityList');
    Route::get('term-activity-list/changeStatus', [TermActivityListController::class,'changeStatus'])->name('changeStatusTermActivityList');
    /*Type Routes*/
    Route::resource('types', TypeController::class);
    Route::delete('type/bulk-delete', [TypeController::class,'bulk_delete'])->name('types.bulk-delete');
    Route::get('type/ajax-get', [TypeController::class,'getTypesAjax'])->name('ajaxGetType');
    Route::get('type/changeStatus', [TypeController::class,'changeStatus'])->name('changeStatusType');

    /*countries Routes*/
    Route::resource('countries', CountryController::class);

    Route::delete('country/bulk-delete', [CountryController::class,'bulk_delete'])->name('countries.bulk-delete');
    /*states Routes*/
    Route::resource('states', StateController::class);

    Route::get('state/changeStatus', [StateController::class,'changeStatus'])->name('changeStatusState');

    Route::delete('state/bulk-delete', [StateController::class,'bulk_delete'])->name('states.bulk-delete');

     }); // end terms route grouping



     // Custom Icon Resource

    // Route::resource('custom-icons', CustomIconController::class);
    Route::prefix('settings')->name('settings.')->group(function() {

      // Media Resource
    Route::get('media-object', [FileController::class,'index'])->name('media-object.index');
    Route::delete('media-object/{id}', [FileController::class,'destroy'])->name('media-object.destroy');
    Route::get('media-used-object/{id}', [FileController::class,'media_used_objects'])->name('media-used-object');

    /*theme-settings Routes*/
    Route::get('theme-settings', [SettingController::class,'index'])->name('theme-settings.index');
    Route::get('theme-settings/create', [SettingController::class,'create'])->name('theme-settings.create');
    Route::post('theme-settings/{setting}', [SettingController::class,'store'])->name('theme-settings.store');
    //Route::post('theme-settings', [SettingController::class,'store'])->name('store');
    /*video gallery Routes*/
    Route::resource('video-galleries', VideoGalleryController::class);
    Route::get('gallery-video', [VideoGalleryController::class,'gallery_videos'])->name('gallery-video');
    Route::post('gallery-video', [VideoGalleryController::class,'gallery_videos']);
    Route::delete('video-gallery/bulk-delete', [VideoGalleryController::class,'bulk_delete'])->name('video-galleries.bulk-delete'); 

    Route::prefix('custom-icons')->name('custom-icons.')->group(function() {
    Route::get('/', [CustomIconController::class,'index'])->name('index');
    Route::post('/', [CustomIconController::class,'store'])->name('store');
    Route::delete('/{custom_icon}', [CustomIconController::class,'destroy'])->name('destroy');
    });
    Route::prefix('custom-icon')->name('custom-icon.')->group(function() {

    Route::delete('bulk-delete', [CustomIconController::class,'bulk_delete'])->name('bulk-delete');

    });
});


     // Hotel Resource
    Route::resource('hotels', HotelController::class);
    Route::prefix('hotels')->name('hotels.')->group(function() {

    });

     Route::delete('hotel/bulk-delete', [HotelController::class,'bulk_delete'])->name('hotel.bulk-delete');
     Route::get('hotel/changeStatus', [HotelController::class,'changeStatus'])->name('changeStatusHotel');
      /*trashed route hotel*/
       Route::delete('hotel/empty-trashed',[HotelController::class,'empty_trashed'])->name('hotel.empty-trashed');
     Route::get('hotel/trashed',[HotelController::class,'trashed_hotels'])->name('hotel.trashed');
    Route::delete('hotels/force-delete/{id}',[HotelController::class,'permanent_delete'])->name('hotel.force-delete');
    Route::put('hotel/trashed/restore/{id}',[HotelController::class,'restore_hotel'])->name('hotel.restore');
    Route::post('hotel/restore-bulk',[HotelController::class,'restore_hotels'])->name('hotel.restore-bulk');
    Route::post('hotel/restore-all',[HotelController::class,'restore_hotels'])->name('hotel.restore-all');
    Route::delete('hotel/bulk-force-delete', [HotelController::class,'bulk_force_delete'])->name('hotel.bulk-force-delete');




     // Tour Resource
    Route::resource('tours', TourController::class);
    Route::prefix('tours')->name('tours.')->group(function() {

    });

    Route::delete('tour/bulk-delete', [TourController::class,'bulk_delete'])->name('tours.bulk-delete');
     Route::get('tour/changeStatus', [TourController::class,'changeStatus'])->name('changeStatusTour');

     /*trashed route tour*/
       Route::delete('tour/empty-trashed',[TourController::class,'empty_trashed'])->name('tour.empty-trashed');
     Route::get('tour/trashed',[TourController::class,'trashed_tours'])->name('tour.trashed');
    Route::delete('tours/force-delete/{id}',[TourController::class,'permanent_delete'])->name('tour.force-delete');
    Route::put('tour/trashed/restore/{id}',[TourController::class,'restore_tour'])->name('tour.restore');
    Route::post('tour/restore-bulk',[TourController::class,'restore_tours'])->name('tour.restore-bulk');
    Route::post('tour/restore-all',[TourController::class,'restore_tours'])->name('tour.restore-all');
    Route::delete('tour/bulk-force-delete', [TourController::class,'bulk_force_delete'])->name('tour.bulk-force-delete');

     // Post Resource
    Route::resource('posts', PostController::class);
    /*trashed route post*/
    Route::delete('post/empty-trashed',[PostController::class,'empty_trashed'])->name('post.empty-trashed');
    Route::get('post/trashed',[PostController::class,'trashed_posts'])->name('post.trashed');
    Route::delete('posts/force-delete/{id}',[PostController::class,'permanent_delete'])->name('post.force-delete');
    Route::put('post/trashed/restore/{id}',[PostController::class,'restore_post'])->name('post.restore');
    Route::post('post/restore-bulk',[PostController::class,'restore_posts'])->name('post.restore-bulk');
    Route::post('post/restore-all',[PostController::class,'restore_posts'])->name('post.restore-all');
    Route::prefix('posts')->name('posts.')->group(function() {
       
    });

    Route::delete('post/bulk-force-delete', [PostController::class,'bulk_force_delete'])->name('post.bulk-force-delete');
    Route::delete('post/bulk-delete', [PostController::class,'bulk_delete'])->name('posts.bulk-delete');
     Route::get('post/changeStatus', [PostController::class,'changeStatus'])->name('changeStatusPost');
     // Page Resource

    Route::prefix('pages')->name('pages.')->group(function() {
        Route::get('/', [PagesController::class,'pages'])->name('pageIndex');
        Route::get('/extra-data/{view}', [PagesController::class,'page_templates'])->name('pageExtraData');
        Route::get('/create', [PagesController::class,'create'])->name('create');
        Route::post('/', [PagesController::class,'store'])->name('store');
        Route::get('/{page}/edit', [PagesController::class,'edit'])->name('edit');
        Route::put('/{page}', [PagesController::class,'update'])->name('update');
        Route::delete('/{page}', [PagesController::class,'destroy'])->name('destroy');

    });
     

    Route::delete('page/bulk-delete', [PagesController::class,'bulk_delete'])->name('pages.bulk-delete');
     Route::get('page/changeStatus', [PagesController::class,'changeStatus'])->name('changeStatusPage');

      /*trashed route page*/
       Route::delete('page/empty-trashed',[PagesController::class,'empty_trashed'])->name('page.empty-trashed');
     Route::get('page/trashed',[PagesController::class,'trashed_pages'])->name('page.trashed');
    Route::delete('pages/force-delete/{id}',[PagesController::class,'permanent_delete'])->name('page.force-delete');
    Route::put('page/trashed/restore/{id}',[PagesController::class,'restore_page'])->name('page.restore');
    Route::post('page/restore-bulk',[PagesController::class,'restore_pages'])->name('page.restore-bulk');
    Route::post('page/restore-all',[PagesController::class,'restore_pages'])->name('page.restore-all');
    Route::delete('page/bulk-force-delete', [PagesController::class,'bulk_force_delete'])->name('page.bulk-force-delete');

     // Room Resource
    Route::resource('rooms', RoomController::class);
    Route::prefix('rooms')->name('rooms.')->group(function() {
    });

    Route::delete('room/bulk-delete', [RoomController::class,'bulk_delete'])->name('rooms.bulk-delete');
     Route::get('room/changeStatus', [RoomController::class,'changeStatus'])->name('changeStatusRoom');

       /*trashed route room*/
        Route::delete('room/empty-trashed',[RoomController::class,'empty_trashed'])->name('room.empty-trashed');
     Route::get('room/trashed',[RoomController::class,'trashed_rooms'])->name('room.trashed');
    Route::delete('rooms/force-delete/{id}',[RoomController::class,'permanent_delete'])->name('room.force-delete');
    Route::put('room/trashed/restore/{id}',[RoomController::class,'restore_room'])->name('room.restore');
    Route::post('room/restore-bulk',[RoomController::class,'restore_rooms'])->name('room.restore-bulk');
    Route::post('room/restore-all',[RoomController::class,'restore_rooms'])->name('room.restore-all');
    Route::delete('room/bulk-force-delete', [RoomController::class,'bulk_force_delete'])->name('room.bulk-force-delete');

     // Location Resource
    Route::resource('locations', locationController::class);
    Route::prefix('locations')->name('locations.')->group(function() {

    });
    Route::delete('location/bulk-delete', [locationController::class,'bulk_delete'])->name('location.bulk-delete');
    Route::get('location/changeStatus', [locationController::class,'changeStatus'])->name('changeStatusLocation');

    /*trashed route location*/
       Route::delete('location/empty-trashed',[LocationController::class,'empty_trashed'])->name('location.empty-trashed');
     Route::get('location/trashed',[LocationController::class,'trashed_locations'])->name('location.trashed');
    Route::delete('locations/force-delete/{id}',[LocationController::class,'permanent_delete'])->name('location.force-delete');
    Route::put('location/trashed/restore/{id}',[LocationController::class,'restore_location'])->name('location.restore');
    Route::post('location/restore-bulk',[LocationController::class,'restore_locations'])->name('location.restore-bulk');
    Route::post('location/restore-all',[LocationController::class,'restore_locations'])->name('location.restore-all');
    Route::delete('location/bulk-force-delete', [LocationController::class,'bulk_force_delete'])->name('location.bulk-force-delete');

    // Country Zone Resource
    Route::prefix('country-zones')->name('country-zones.')->group(function() {
    Route::resource('/', CountryZoneController::class)->parameters(['' => 'country_zone']);
    });

    Route::delete('country-zone/bulk-delete', [CountryZoneController::class,'bulk_delete'])->name('country-zones.bulk-delete');
    Route::get('country-zone/changeStatus', [CountryZoneController::class,'changeStatus'])->name('changeStatusCountryZone');

    /*trashed route country zone*/
       Route::delete('country-zone/empty-trashed',[CountryZoneController::class,'empty_trashed'])->name('country-zone.empty-trashed');
     Route::get('country-zone/trashed',[CountryZoneController::class,'trashed_countryZones'])->name('country-zone.trashed');
    Route::delete('country-zones/force-delete/{id}',[CountryZoneController::class,'permanent_delete'])->name('country-zone.force-delete');
    Route::put('country-zone/trashed/restore/{id}',[CountryZoneController::class,'restore_countryZone'])->name('country-zone.restore');
    Route::post('country-zone/restore-bulk',[CountryZoneController::class,'restore_countryZones'])->name('country-zone.restore-bulk');
    Route::post('country-zone/restore-all',[CountryZoneController::class,'restore_countryZones'])->name('country-zone.restore-all');
    Route::delete('country-zone/bulk-force-delete', [CountryZoneController::class,'bulk_force_delete'])->name('country-zone.bulk-force-delete');
    // Activity Zone Resource
    Route::prefix('activity-zones')->name('activity-zones.')->group(function() {
    Route::resource('/', ActivityZoneController::class)->parameters(['' => 'activity_zone']);
    });
    // Activity Zone Resource
    Route::delete('activity-zone/bulk-delete', [ActivityZoneController::class,'bulk_delete'])->name('activity-zones.bulk-delete');
    Route::get('activity-zone/changeStatus', [ActivityZoneController::class,'changeStatus'])->name('changeStatusActivityZone');
    // Activity l̥īst Resource
    Route::prefix('activity-lists')->name('activity-lists.')->group(function() {
    Route::resource('/', ActivityListsController::class)->parameters(['' => 'activity_list']);
    });
     /*trashed route activity zone*/
       Route::delete('activity-zone/empty-trashed',[ActivityZoneController::class,'empty_trashed'])->name('activity-zone.empty-trashed');
     Route::get('activity-zone/trashed',[ActivityZoneController::class,'trashed_activityZones'])->name('activity-zone.trashed');
    Route::delete('activity-zones/force-delete/{id}',[ActivityZoneController::class,'permanent_delete'])->name('activity-zone.force-delete');
    Route::put('activity-zone/trashed/restore/{id}',[ActivityZoneController::class,'restore_activityZone'])->name('activity-zone.restore');
    Route::post('activity-zone/restore-bulk',[ActivityZoneController::class,'restore_activityZones'])->name('activity-zone.restore-bulk');
    Route::post('activity-zone/restore-all',[ActivityZoneController::class,'restore_activityZones'])->name('activity-zone.restore-all');
    Route::delete('activity-zone/bulk-force-delete', [ActivityZoneController::class,'bulk_force_delete'])->name('activity-zone.bulk-force-delete');
    // Tourism Zone Resource
    Route::prefix('tourism-zones')->name('tourism-zones.')->group(function() {
    Route::resource('/', TourismZoneController::class)->parameters(['' => 'tourism_zone']);
    });

    Route::delete('tourism-zone/bulk-delete', [TourismZoneController::class,'bulk_delete'])->name('tourism-zones.bulk-delete');
    Route::get('tourism-zone/changeStatus', [TourismZoneController::class,'changeStatus'])->name('changeStatusTourismZone');
     /*trashed route tourism zone*/
       Route::delete('tourism-zone/empty-trashed',[TourismZoneController::class,'empty_trashed'])->name('tourism-zone.empty-trashed');
     Route::get('tourism-zone/trashed',[TourismZoneController::class,'trashed_tourismZones'])->name('tourism-zone.trashed');
    Route::delete('tourism-zones/force-delete/{id}',[TourismZoneController::class,'permanent_delete'])->name('tourism-zones.force-delete');
    Route::put('tourism-zone/trashed/restore/{id}',[TourismZoneController::class,'restore_tourismZone'])->name('tourism-zone.restore');
    Route::post('tourism-zone/restore-bulk',[TourismZoneController::class,'restore_tourismZones'])->name('tourism-zone.restore-bulk');
    Route::post('tourism-zone/restore-all',[TourismZoneController::class,'restore_tourismZones'])->name('tourism-zone.restore-all');
    Route::delete('tourism-zone/bulk-force-delete', [TourismZoneController::class,'bulk_force_delete'])->name('tourism-zone.bulk-force-delete');
// Activity list Resource
    Route::delete('activity-list/bulk-delete', [ActivityListsController::class,'bulk_delete'])->name('activity-lists.bulk-delete');
    Route::get('activity-list/changeStatus', [ActivityListsController::class,'changeStatus'])->name('changeStatusActivityLists');
   
    /*trashed route activity list*/
       Route::delete('activity-list/empty-trashed',[ActivityListsController::class,'empty_trashed'])->name('activity-list.empty-trashed');
     Route::get('activity-list/trashed',[ActivityListsController::class,'trashed_activityLists'])->name('activity-list.trashed');
    Route::delete('activity-lists/force-delete/{id}',[ActivityListsController::class,'permanent_delete'])->name('activity-list.force-delete');
    Route::put('activity-list/trashed/restore/{id}',[ActivityListsController::class,'restore_activityList'])->name('activity-list.restore');
    Route::post('activity-list/restore-bulk',[ActivityListsController::class,'restore_activityLists'])->name('activity-list.restore-bulk');
    Route::post('activity-list/restore-all',[ActivityListsController::class,'restore_activityLists'])->name('activity-list.restore-all');
    Route::delete('activity-list/bulk-force-delete', [ActivityListsController::class,'bulk_force_delete'])->name('activity-list.bulk-force-delete');
 // Activity package Resource
    Route::prefix('activity-packages')->name('activity-packages.')->group(function() {
    Route::resource('/', ActivityPackageController::class)->parameters(['' => 'activity_list']);
    });
    Route::delete('activity-package/bulk-delete', [ActivityPackageController::class,'bulk_delete'])->name('activity-packages.bulk-delete');
    Route::get('activity-package/changeStatus', [ActivityPackageController::class,'changeStatus'])->name('changeStatusActivityPackage');
  
   /*trashed route activity package*/
       Route::delete('activity-package/empty-trashed',[ActivityPackageController::class,'empty_trashed'])->name('activity-package.empty-trashed');
     Route::get('activity-package/trashed',[ActivityPackageController::class,'trashed_activityPackages'])->name('activity-package.trashed');
    Route::delete('activity-packages/force-delete/{id}',[ActivityPackageController::class,'permanent_delete'])->name('activity-package.force-delete');
    Route::put('activity-package/trashed/restore/{id}',[ActivityPackageController::class,'restore_activityPackage'])->name('activity-package.restore');
    Route::post('activity-package/restore-bulk',[ActivityPackageController::class,'restore_activityPackages'])->name('activity-package.restore-bulk');
    Route::post('activity-package/restore-all',[ActivityPackageController::class,'restore_activityPackages'])->name('activity-package.restore-all');
    Route::delete('activity-package/bulk-force-delete', [ActivityPackageController::class,'bulk_force_delete'])->name('activity-package.bulk-force-delete');

     // Activity Resource
    Route::prefix('activities')->name('activities.')->group(function() {
    Route::resource('/', ActivityController::class)->parameters([''=>'activity']);
    });
    Route::delete('activity/bulk-delete', [ActivityController::class,'bulk_delete'])->name('activities.bulk-delete');

      /*trashed route activity*/
       Route::delete('activity/empty-trashed',[activityController::class,'empty_trashed'])->name('activity.empty-trashed');
     Route::get('activity/trashed',[activityController::class,'trashed_activities'])->name('activity.trashed');
    Route::delete('activities/force-delete/{id}',[activityController::class,'permanent_delete'])->name('activity.force-delete');
    Route::put('activity/trashed/restore/{id}',[activityController::class,'restore_activity'])->name('activity.restore');
    Route::post('activity/restore-bulk',[activityController::class,'restore_activities'])->name('activity.restore-bulk');
    Route::post('activity/restore-all',[activityController::class,'restore_activities'])->name('activity.restore-all');
    Route::delete('activity/bulk-force-delete', [activityController::class,'bulk_force_delete'])->name('activity.bulk-force-delete');

    Route::get('activity/country/activity-zones', [ActivityController::class,'ActivityZoneByCountry'])->name('ActivityZoneByCountry');

    Route::get('tour/country/country-zones', [TourController::class,'CountryZoneByCountry'])->name('CountryZoneByCountry');

    Route::get('activity/changeStatus', [ActivityController::class,'changeStatus'])->name('changeStatusActivity');


    Route::resource('conversions', ConversionController::class);
    Route::delete('conversions/bulk-delete', [ConversionController::class,'bulk_delete'])->name('conversions.bulk-delete');
    Route::get('conversion/changeStatus', [ConversionController::class,'changeStatus'])->name('conversions.changeStatus');

    Route::middleware(['isAdmin'])->group(function() {

        Route::resource('users', UserController::class);
        Route::delete('users/bulk-delete', [UserController::class,'bulk_delete'])->name('users.bulk-delete');
        Route::get('users/changeStatus', [UserController::class,'changeStatus'])->name('users.changeStatus');
        Route::post('users/userAsgin',[UserController::class,'userAsgin'])->name('users.userAsgin');
        Route::get('users/userAsgin/{id}',[UserController::class,'userAsginShow'])->name('user.userAsgin');


    });


});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
