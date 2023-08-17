<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\MedicareAssistanceController;
use App\Http\Controllers\TopServiceController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\HotelController;
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
    Route::get('accessible/ajax-get', [AccessibleController::class,'getaccessiblesAjax'])->name('ajaxGetAccessible');
    Route::get('accessible/changeStatus', [AccessibleController::class,'changeStatus'])->name('changeStatusAccessible'); 

     }); // end terms route grouping
     // Hotel Resource
    Route::prefix('hotels')->name('hotels.')->group(function() {
        Route::get('/', [HotelController::class, 'index'])->name('index');
        Route::get('create', [HotelController::class, 'create'])->name('create');
    });
});
