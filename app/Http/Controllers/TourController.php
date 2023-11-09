<?php

namespace App\Http\Controllers;

use App\Interfaces\CountryZoneRepositoryInterface;
use App\Interfaces\TypeRepositoryInterface;
use App\Interfaces\LocationRepositoryInterface;
use App\Interfaces\PackageTypeRepositoryInterface;
use App\Interfaces\OtherPackageRepositoryInterface;
use App\Interfaces\TourRepositoryInterface;
use App\Interfaces\StateRepositoryInterface;
use App\Interfaces\LanguageRepositoryInterface;
use App\Models\Tour;
use App\Models\TourDetail;
use App\Models\Location;
use App\Http\Requests\StoreTourRequest;
use App\Http\Requests\UpdateTourRequest;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\DataTables\TourDataTable;
use Session;

class TourController extends Controller
{


    private CountryZoneRepositoryInterface $countryZoneRepository;
    private TypeRepositoryInterface $typeRepository;
    private PackageTypeRepositoryInterface $packageTypeRepository;

    private OtherPackageRepositoryInterface $otherPackageRepository;

    private LocationRepositoryInterface $locationRepository;
    private StateRepositoryInterface $stateRepository;
    private LanguageRepositoryInterface $languageRepository;
    private TourRepositoryInterface $tourRepository;

    public function __construct(

        CountryZoneRepositoryInterface $countryZoneRepository,
        TourRepositoryInterface $tourRepository,
        TypeRepositoryInterface $typeRepository,
        PackageTypeRepositoryInterface $packageTypeRepository,
        OtherPackageRepositoryInterface $otherPackageRepository,
        LocationRepositoryInterface $locationRepository,
        StateRepositoryInterface $stateRepository,
        LanguageRepositoryInterface $languageRepository

    ) {
        $this->countryZoneRepository = $countryZoneRepository;
        $this->typeRepository = $typeRepository;
        $this->packageTypeRepository = $packageTypeRepository;
        $this->otherPackageRepository = $otherPackageRepository;
        $this->locationRepository = $locationRepository;
        $this->stateRepository = $stateRepository;
        $this->tourRepository = $tourRepository;
        $this->languageRepository = $languageRepository;

    }

    private function _prepareBasicData() {

        // TODO: Need to Improve here (Fetch from Cache)
        $data['types'] = $this->typeRepository->getActiveTourTypesList();
        $data['package_types'] = $this->packageTypeRepository->getActiveTourPackageTypesList();
        $data['other_packages'] = $this->otherPackageRepository->getActiveTourOtherPackagesList();
        $data['states'] = $this->stateRepository->getActiveStatesList()->map(function($value, $key){  

          return (object)[
            'id' => $value->id,
            'value' => $value->name,
            'parent_id' => $value->name,
        ];                                

    });
        $data['languages'] = $this->languageRepository->getActiveLanguagesList();
        $data['locations'] = $this->locationRepository->getActiveLocationsList();
        return $data;

    }

    public function CountryZoneByCountry(Request $request): JsonResponse
    {

        $existed_value = "";
        $country = $request->country;
        if (isset($request->id)) {
            $tourId = $request->id;
            $tour = tour::findOrFail($tourId);
            if (!empty($tour)) {
                if (!empty($tour->country_zone)) {
                   $existed_value = $tour->country_zone->id;
               }
           }
       }
       $countryZone = $this->countryZoneRepository->getCountryZoneByCountry($country)->toArray();

       return response()->json(['data' => $countryZone,'existed_value'=>$existed_value]);
   }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TourDataTable $dataTable)
    {
        $data['tours'] = Tour::count();
        $data['title'] = 'Tour List';
        return $dataTable->render('admin.tours.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $data['title'] = 'Tour Add';
      $data['tour'] = new Tour();
      $data = array_merge_recursive($data, $this->_prepareBasicData());

      return view('admin.tours.create', $data);
  }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTourRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTourRequest $request)
    {
        
     //   if (isset($request->featured_image)) {
     
     //     $request->merge([
     //        'featured_image' => json_decode($request->featured_image,true),
     //    ]);
     // }

        $tourDetails = [

            'name' => $request->name,
            'slug' => SlugService::createSlug(Tour::class, 'slug', $request->name),
            'description' => $request->description,
            'excerpt' => $request->excerpt,
            'external_link' =>$request->external_link,
            'address' => $request->address,
            'country_zone_id' => $request->country_zone_id,
            // 'tour_price_by' =>$request->tour_price_by,
            'price' => (!empty($request->price))?$request->price:0,
            // 'sale_price' =>$request->sale_price,
            // 'child_price' =>$request->child_price,
            // 'adult_price' =>$request->adult_price,
            // 'infant_price' =>$request->infant_price,
            // 'min_price' =>$request->min_price,
            'min_people' => (!empty($request->min_people))?$request->min_people:0,
            'max_people' => (!empty($request->max_people))?$request->max_people:0,
            'type_tour' => $request->type_tour,
            // 'check_in' =>$request->check_in,
            // 'check_out' =>$request->check_out,
            'rate_review' => (!empty($request->rate_review))?$request->rate_review:0,
            'duration_day' => $request->duration_day,
            'tours_booking_period' => $request->tours_booking_period,
            'is_sale_schedule' => $request->is_sale_schedule,
            'discount' => (!empty($request->discount))?$request->discount:0,
            'sale_price_from' => $request->sale_price_from,
            'sale_price_to' => $request->sale_price_to,
            'price_type' => $request->price_type,
            'is_featured' => $request->is_featured,
            // 'logo'=>$request->logo,
            'featured_image' => $request->featured_image,
            // 'discount_type' =>$request->discount_type,
            // 'discount_by_child' =>$request->discount_by_child,
            // 'discount_by_adult' =>$request->discount_by_adult,
            // 'discount_by_people_type' =>$request->discount_by_people_type,
            // 'calculator_discount_by_people_type' =>$request->calculator_discount_by_people_type,
            // 'hide_adult_in_booking_form' =>$request->hide_adult_in_booking_form,
            // 'hide_children_in_booking_form' =>$request->hide_children_in_booking_form,
            // 'hide_infant_in_booking_form' =>$request->hide_infant_in_booking_form,
            // 'disable_adult_name' =>$request->disable_adult_name,
            // 'disable_children_name' =>$request->disable_children_name,
            // 'disable_infant_name' =>$request->disable_infant_name,
            // 'extra_price'=>$request->extra_price,
            // 'deposit_payment_status' =>$request->deposit_payment_status,
            // 'deposit_payment_amount' =>$request->deposit_payment_amount,
            'status' => $request->status,



            // TODO: created_by pending as Authentication is not Yet Completed
        ];

        if (isset($request->tours_program_style)) {
           if ($request->tours_program_style == 'style1' || $request->tours_program_style == 'style3') {
               $request->merge([
                'tours_program_bgr' => [],
            ]);
           }elseif ($request->tours_program_style == 'style2') {
               $request->merge([
                'tours_program' => [],
            ]);
           }elseif ($request->tours_program_style == 'style4') {
               $request->merge([
                'tours_program_style4' => [],
            ]);
           }
       }


       if ($request->has('st_tour_external_booking') && $request->st_tour_external_booking == 0) {
          $request->merge([
            'st_tour_external_booking_link' => null,
        ]);
      }

      $tour = $this->tourRepository->createTour($tourDetails);

      if ($tour) {
            // TODO: Move this to Repository
        $tourMetaData = [

         "map_address" , 
         "latitude" , 
         "longitude" , 
         "zoom_level" , 
          // 'enable_street_views_google_map',
          //'is_iframe',
         "st_booking_option_type" , 
         "gallery" , 
         "video" , 
         "contact" ,
         "st_tour_external_booking" , 
         "st_tour_external_booking_link" ,
         "tours_coupan" , 
         "tours_include" , 
         "tours_exclude" , 
         "tours_highlight" , 
         "tour_sponsored_by" ,
         "tours_destinations" , 
         "tour_helpful_facts" , 
         "tour_program_style" , 
         "tours_program" , 
         "tours_program_bgr",
         "tours_program_style4",
         "tours_faq" , 
           // 'calendar_check_in',
          // 'calendar_check_out',
          // 'calendar_adult_price',
          // 'calendar_child_price',
          // 'calendar_infant_price',
          // 'calendar_starttime_hour',
          // 'calendar_starttime_minute',
          // 'calendar_starttime_format',
          // 'calendar_status',
          // 'calendar_groupday',
          // 'st_allow_cancel',
          // 'st_cancel_number_days',
          // 'st_cancel_percent',
          // 'ical_url',
          // 'is_meta_payment_gateway_st_submit_form',
         "package_route" , 
         "st_tours_country" ,
         "helpful_facts" , 
         "social_links",
         "sponsored",
         // "properties_near_by",
         "check_editing",

     ];

     $tour->detail()->create($request->only($tourMetaData));


     $tour->package_types()->attach($request->get('package_types'));
     $tour->other_packages()->attach($request->get('other_packages'));
     $tour->types()->attach($request->get('types'));
     $tour->languages()->attach($request->get('language'));
     $tour->states()->attach($request->get('state_id'));
     
     $tour->locations()->attach($request->get('location_id'));


            // 
 }


        // return $tour;
 Session::flash('success','Tour Created Successfully');
 return redirect()->Route('admin.tours.index');
}

public function changeStatus(Request $request): JsonResponse
{
    $tourId = $request->id;
    $tourDetails = [
        'status' => $request->status,
    ];
    $this->tourRepository->updateTour($tourId, $tourDetails);

    return response()->json(['success' => 'Status change successfully.']);
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function show(Tour $tour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function edit(Tour $tour)
    {
       $tour->with([
        'types', 'package_types', 'other_packages', 'states', 'languages','locations']);

       if (empty($tour)) {
        return back();
    }

    $data['title'] = 'Tour Edit';
    $data['tour'] = $tour;
    $data = array_merge_recursive($data, $this->_prepareBasicData());

    return view('admin.tours.edit', $data);
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTourRequest  $request
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTourRequest $request, Tour $tour)
    {


     //   if (isset($request->featured_image)) {

     //     $request->merge([
     //        'featured_image' => json_decode($request->featured_image,true),
     //    ]);
     // }
       $tourDetails = [

        'name' => $request->name,
            //'slug' => SlugService::createSlug(Tour::class, 'slug', $request->name),
        'description' => $request->description,
        'excerpt' => $request->excerpt,
        'external_link' =>$request->external_link,
        'address' => $request->address,
        'country_zone_id' => $request->country_zone_id,
            // 'tour_price_by' =>$request->tour_price_by,
        'price' => (!empty($request->price))?$request->price:0,
            // 'sale_price' =>$request->sale_price,
            // 'child_price' =>$request->child_price,
            // 'adult_price' =>$request->adult_price,
            // 'infant_price' =>$request->infant_price,
            // 'min_price' =>$request->min_price,
        'min_people' => (!empty($request->min_people))?$request->min_people:0,
        'max_people' => (!empty($request->max_people))?$request->max_people:0,
        'type_tour' => $request->type_tour,
            // 'check_in' =>$request->check_in,
            // 'check_out' =>$request->check_out,
        'rate_review' => (!empty($request->rate_review))?$request->rate_review:0,
        'duration_day' => $request->duration_day,
        'tours_booking_period' => $request->tours_booking_period,
        'is_sale_schedule' => $request->is_sale_schedule,
        'discount' => (!empty($request->discount))?$request->discount:0,
        'sale_price_from' => $request->sale_price_from,
        'sale_price_to' => $request->sale_price_to,
        'price_type' => $request->price_type,
        'is_featured' => $request->is_featured,
            // 'logo'=>$request->logo,
        'featured_image' => $request->featured_image,
            // 'discount_type' =>$request->discount_type,
            // 'discount_by_child' =>$request->discount_by_child,
            // 'discount_by_adult' =>$request->discount_by_adult,
            // 'discount_by_people_type' =>$request->discount_by_people_type,
            // 'calculator_discount_by_people_type' =>$request->calculator_discount_by_people_type,
            // 'hide_adult_in_booking_form' =>$request->hide_adult_in_booking_form,
            // 'hide_children_in_booking_form' =>$request->hide_children_in_booking_form,
            // 'hide_infant_in_booking_form' =>$request->hide_infant_in_booking_form,
            // 'disable_adult_name' =>$request->disable_adult_name,
            // 'disable_children_name' =>$request->disable_children_name,
            // 'disable_infant_name' =>$request->disable_infant_name,
            // 'extra_price'=>$request->extra_price,
            // 'deposit_payment_status' =>$request->deposit_payment_status,
            // 'deposit_payment_amount' =>$request->deposit_payment_amount,
        'status' => $request->status,



            // TODO: created_by pending as Authentication is not Yet Completed
    ];

    if (isset($request->tours_program_style)) {
       if ($request->tours_program_style == 'style1' || $request->tours_program_style == 'style3') {
           $request->merge([
            'tours_program_bgr' => [],
        ]);
       }elseif ($request->tours_program_style == 'style2') {
           $request->merge([
            'tours_program' => [],
        ]);
       }elseif ($request->tours_program_style == 'style4') {
           $request->merge([
            'tours_program_style4' => [],
        ]);
       }
   }


   if ($request->has('st_tour_external_booking') && $request->st_tour_external_booking == 0) {
      $request->merge([
        'st_tour_external_booking_link' => null,
    ]);
  }

  $this->tourRepository->updateTour($tour->id,$tourDetails);

  if ($tour) {
            // TODO: Move this to Repository

    $tourMetaData = [

     "map_address" , 
     "latitude" , 
     "longitude" , 
     "zoom_level" , 
          // 'enable_street_views_google_map',
          //'is_iframe',
     "st_booking_option_type" , 
     "gallery" , 
     "video" , 
     "contact" ,
     "st_tour_external_booking" , 
     "st_tour_external_booking_link" ,
     "tours_coupan" , 
     "tours_include" , 
     "tours_exclude" , 
     "tours_highlight" , 
     "tour_sponsored_by" ,
     "tours_destinations" , 
     "tour_helpful_facts" , 
     "tour_program_style" , 
     "tours_program" , 
     "tours_program_bgr",
     "tours_program_style4",
     "tours_faq" , 
           // 'calendar_check_in',
          // 'calendar_check_out',
          // 'calendar_adult_price',
          // 'calendar_child_price',
          // 'calendar_infant_price',
          // 'calendar_starttime_hour',
          // 'calendar_starttime_minute',
          // 'calendar_starttime_format',
          // 'calendar_status',
          // 'calendar_groupday',
          // 'st_allow_cancel',
          // 'st_cancel_number_days',
          // 'st_cancel_percent',
          // 'ical_url',
          // 'is_meta_payment_gateway_st_submit_form',
     "package_route" , 
     "st_tours_country" ,
     "helpful_facts" , 
     "social_links",
     "sponsored",
         // "properties_near_by",
     "check_editing",

 ];

 $tour->detail()->update($request->only($tourMetaData));
     // if (!empty($tour->detail())) {
     // }else{
     //     $tour->detail()->create($request->only($tourMetaData));
     // }


 $tour->package_types()->sync($request->get('package_types'));
 $tour->other_packages()->sync($request->get('other_packages'));
 $tour->types()->sync($request->get('type'));
 $tour->languages()->sync($request->get('language'));
 $tour->states()->sync($request->get('state_id'));
 $tour->locations()->sync($request->get('location_id'));
}
            // return $tour;
Session::flash('success','Tour Updated Successfully');
return redirect()->Route('admin.tours.edit',$tour->id);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tour  $tour
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tour $tour)
    {
       $tourId = $tour->id;
       $this->tourRepository->deleteTour($tourId);
       Session::flash('success','Tour Deleted Successfully');
       return back();
   }


   public function bulk_delete(Request $request)
   {
    if (!empty($request->ids)) {

        $tourIds = get_array_mapping(json_decode($request->ids));
        $this->tourRepository->deleteBulkTour($tourIds);
        Session::flash('success', 'tour Bulk Deleted Successfully');
    }
    return back();
}
}
