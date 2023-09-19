<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\MedicareAssistanceController;
use App\Http\Controllers\TopServiceController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\AccessibleController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\MeetingAndEventController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\locationController;
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
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::name('admin.')->prefix('admin')->group(function () {

    Route::get('template/{type}', [UtilityController::class, 'get_template_by_type'])->name('template');

    Route::name('files.')->prefix('files')->group(function() {
        Route::get('load-images', [FileController::class, 'loadImages'])->name('load');
        Route::post('upload', [FileController::class, 'uploadImages'])->name('upload');
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

    /*Amenities Routes*/
    Route::resource('amenities', AmenityController::class);
        Route::delete('amenity/bulk-delete', [AmenityController::class,'bulk_delete'])->name('amenities.bulk-delete');
    Route::get('amenity/ajax-get', [AmenityController::class,'getAmenitiesAjax'])->name('ajaxGetAmenity');
    Route::get('amenity/changeStatus', [AmenityController::class,'changeStatus'])->name('changeStatusAmenity');

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

    /*Property Type Routes*/
    Route::resource('property-types', PropertyTypeController::class);
     Route::delete('property-type/bulk-delete', [PropertyTypeController::class,'bulk_delete'])->name('property-types.bulk-delete');
    Route::get('property-type/ajax-get', [PropertyTypeController::class,'getPropertyTypesAjax'])->name('ajaxGetPropertyType');
    Route::get('property-type/changeStatus', [PropertyTypeController::class,'changeStatus'])->name('changeStatusPropertyType');
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

     // Hotel Resource
    Route::resource('hotels', HotelController::class);
    Route::prefix('hotels')->name('hotels.')->group(function() {
    });

    Route::delete('hotel/bulk-delete', [HotelController::class,'bulk_delete'])->name('hotel.bulk-delete');
     Route::get('hotel/changeStatus', [HotelController::class,'changeStatus'])->name('changeStatusHotel');

     // Location Resource
    Route::prefix('locations')->name('locations.')->group(function() {
    Route::resource('/', locationController::class)->parameters(['' => 'location']);

    }); 
    Route::delete('location/bulk-delete', [locationController::class,'bulk_delete'])->name('location.bulk-delete');
    Route::get('location/changeStatus', [locationController::class,'changeStatus'])->name('changeStatusLocation');

    // Country Zone Resource
    Route::prefix('country-zones')->name('country-zones.')->group(function() {
    Route::resource('/', CountryZoneController::class)->parameters(['' => 'country_zone']);
    });

    Route::delete('country-zone/bulk-delete', [CountryZoneController::class,'bulk_delete'])->name('country-zones.bulk-delete');
    Route::get('country-zone/changeStatus', [CountryZoneController::class,'changeStatus'])->name('changeStatusCountryZone');
    // Activity Zone Resource
    Route::prefix('activity-zones')->name('activity-zones.')->group(function() {
    Route::resource('/', ActivityZoneController::class)->parameters(['' => 'activity_zone']);
    });
    
    Route::delete('activity-zone/bulk-delete', [ActivityZoneController::class,'bulk_delete'])->name('activity-zones.bulk-delete');
    Route::get('activity-zone/changeStatus', [ActivityZoneController::class,'changeStatus'])->name('changeStatusActivityZone');
    // Activity l̥īst Resource
    Route::prefix('activity-lists')->name('activity-lists.')->group(function() {
    Route::resource('/', ActivityListsController::class)->parameters(['' => 'activity_list']);
    });
    
    Route::delete('activity-list/bulk-delete', [ActivityListsController::class,'bulk_delete'])->name('activity-lists.bulk-delete');
    Route::get('activity-list/changeStatus', [ActivityListsController::class,'changeStatus'])->name('changeStatusActivityLists');
    // Activity package Resource
    Route::prefix('activity-packages')->name('activity-packages.')->group(function() {
    Route::resource('/', ActivityPackageController::class)->parameters(['' => 'activity_list']);
    });
    
    Route::delete('activity-package/bulk-delete', [ActivityPackageController::class,'bulk_delete'])->name('activity-packages.bulk-delete');
    Route::get('activity-package/changeStatus', [ActivityPackageController::class,'changeStatus'])->name('changeStatusActivityPackage');
});
