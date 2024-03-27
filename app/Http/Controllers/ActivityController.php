<?php

namespace App\Http\Controllers;
use App\Interfaces\ActivityRepositoryInterface;
use App\Interfaces\ActivityZoneRepositoryInterface;
use App\Interfaces\LocationRepositoryInterface;
use App\Interfaces\TermActivityListRepositoryInterface;
use App\Interfaces\StateRepositoryInterface;
use App\Interfaces\AttractionRepositoryInterface;
use App\Interfaces\LanguageRepositoryInterface;
use App\Models\Activity;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\DataTables\ActivityDataTable;
use App\DataTables\TrashedActivityDataTable;
use Session;
use Auth;

class ActivityController extends Controller
{

    private LocationRepositoryInterface $locationRepository;
    private ActivityZoneRepositoryInterface $activityZoneRepository;
    private TermActivityListRepositoryInterface $termActivityListRepository;
    private StateRepositoryInterface $stateRepository;
    private AttractionRepositoryInterface $attractionRepository;
    private LanguageRepositoryInterface $languageRepository;
    private ActivityRepositoryInterface $activityRepository;

    public function __construct(
        ActivityZoneRepositoryInterface $activityZoneRepository,
        TermActivityListRepositoryInterface $termActivityListRepository,
        ActivityRepositoryInterface $activityRepository,
        LocationRepositoryInterface $locationRepository,
        StateRepositoryInterface $stateRepository,
        AttractionRepositoryInterface $attractionRepository,
        LanguageRepositoryInterface $languageRepository

    ) {
        $this->activityZoneRepository = $activityZoneRepository;
        $this->locationRepository = $locationRepository;
        $this->termActivityListRepository = $termActivityListRepository;
        $this->stateRepository = $stateRepository;
        $this->activityRepository = $activityRepository;
        $this->attractionRepository = $attractionRepository;
        $this->languageRepository = $languageRepository;

    }

    private function _prepareBasicData() {

        // TODO: Need to Improve here (Fetch from Cache)
        $data['term_activity_lists'] = $this->termActivityListRepository->getActiveTermActivityList();
        $data['states'] = $this->stateRepository->getActiveStatesList()->map(function($value, $key){  

          return (object)[
            'id' => $value->id,
            'value' => $value->name,
            'parent_id' => $value->name,
        ];                                

    });
        $data['attractions'] = $this->attractionRepository->getActiveActivityAttractionsList();
        $data['languages'] = $this->languageRepository->getActiveLanguagesList();
        $data['locations'] = $this->locationRepository->getActiveLocationsList();
        return $data;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ActivityDataTable $dataTable)
    {

        if (isset(request()->user) && !empty(request()->user)) {
            $created_by = request()->user;
            $data['activities'] = Activity::where('created_by',$created_by)->count();
        }else{
            $data['activities'] = Activity::count();
        }
        $data['title'] = 'Activity List';
        $data['trashed'] = Activity::onlyTrashed()->count();
        return $dataTable->render('admin.activities.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Activity Add';
        $data['activity'] = new Activity();
        $data = array_merge_recursive($data, $this->_prepareBasicData());

        return view('admin.activities.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreActivityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreActivityRequest $request)
    {

     //   if (isset($request->featured_image)) {

     //     $request->merge([
     //        'featured_image' => json_decode($request->featured_image,true),
     //    ]);
     // }
     $activityDetails = [

      'name' =>$request->name,
      'slug' => SlugService::createSlug(Activity::class, 'slug', $request->name),
      'description' =>$request->description,
      'excerpt' =>$request->excerpt,
      'external_link' =>$request->external_link,
      'address' =>$request->address,
      'price' =>!empty($request->price)?$request->price:0,
          // 'sale_price' =>$request->sale_price,
          // 'child_price' =>$request->child_price,
          // 'disable_children_name' =>$request->disable_children_name,
          // 'hide_children_in_booking_form' =>$request->hide_children_in_booking_form,
          // 'discount_by_child' =>$request->discount_by_child,
          // 'adult_price' =>$request->adult_price,
          // 'hide_adult_in_booking_form' =>$request->hide_adult_in_booking_form,
          // 'discount_by_adult' =>$request->discount_by_adult,
          // 'discount_by_people_type' =>$request->discount_by_people_type,
          // 'calculator_discount_by_people_type' =>$request->calculator_discount_by_people_type,
          // 'infant_price' =>$request->infant_price,
          // 'disable_infant_name' =>$request->disable_infant_name,
          // 'hide_infant_in_booking_form' =>$request->hide_infant_in_booking_form,
          // 'min_price' =>$request->min_price,
          // 'extra_price' =>$request->extra_price,
      'st_activity_external_booking' =>(!empty($request->st_activity_external_booking))?$request->st_activity_external_booking:0,
      'st_activity_external_booking_link' =>$request->st_activity_external_booking_link,
      'deposit_payment_status' =>$request->deposit_payment_status,
      'deposit_payment_amount' =>$request->deposit_payment_amount,
      'type_activity' =>$request->type_activity,
      'rating' =>(!empty($request->rating))?$request->rating:0,
      'activity_booking_period' =>$request->activity_booking_period,
      'min_people' =>(!empty($request->min_people))?$request->min_people:0,
      'max_people' =>(!empty($request->max_people))?$request->max_people:0,
      'duration' =>(!empty($request->duration))?$request->duration:'',
      'is_sale_schedule' =>(!empty($request->is_sale_schedule))?$request->is_sale_schedule:0,
      'discount' =>(!empty($request->discount))?$request->discount:0,
      'sale_price_from' =>$request->sale_price_from,
      'sale_price_to' =>$request->sale_price_to,
      'discount_type' =>$request->discount_type,
      'is_featured' =>$request->is_featured,
      'status' =>$request->status,
      'logo' =>$request->logo,
      'featured_image' =>$request->featured_image,
      'created_by' => (Auth::check())?Auth::user()->id:null,



            // TODO: created_by pending as Authentication is not Yet Completed
  ];
  if (isset($request->activity_program_style)) {
     if ($request->activity_program_style == 'style1' || $request->activity_program_style == 'style3') {
         $request->merge([
            'activity_program_bgr' => [],
        ]);
     }elseif ($request->activity_program_style == 'style2') {
         $request->merge([
            'activity_program' => [],
        ]);
     }

     if (isset($request->activity_zones)) {

        $request->merge([
            'activity_zones' => unsetValueActivityTourismZone($request->activity_zones)
        ]);
    }

    if (empty($request->activity_zone_id)) {

        $request->merge([
            'activity_zone_id' => null
        ]);
    }
}
$activity = $this->activityRepository->createActivity($activityDetails);

if ($activity) {
            // TODO: Move this to Repository
   $activityMetaData = [
      'map_address',
      'latitude',
      'longitude',
      'zoom_level',
      'enable_street_views_google_map',
      'gallery',
      'video',
      'contact',
      'venue_facilities',
      'activity_include',
      'activity_exclude',
      'activity_highlight',
      'activity_program_style',
      'activity_program',
      'activity_program_bgr',
      'activity_faq',
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
      'child_policy',
      'booking_policy',
      'refund_and_cancellation_policy',
      'country',
      'st_activity_external_booking_link',
      'activity_zones',
      'st_activity_corporate_address',
      'st_activity_short_address',
      'social_links',
      'properties_near_by',
      'check_editing',

  ];

  $activity->detail()->create($request->only($activityMetaData));




  $activity->activity_zone()->attach($request->get('activity_zone_id'));
  $activity->attractions()->attach($request->get('attraction'));
  $activity->locations()->attach($request->get('location_id'));
  $activity->languages()->attach($request->get('language'));
  $activity->term_activity_lists()->attach($request->get('term_activity_list'));
  $activity->states()->attach($request->get('state_id'));
            // activitiescard
}
        // return $activity;
Session::flash('success','Activity Created Successfully');
return redirect()->Route('admin.activities.index');
}

public function ActivityZoneByCountry(Request $request): JsonResponse
{

    $existed_value = "";
    $country = $request->country;
    if (isset($request->id)) {
        $activityId = $request->id;
        $activity = Activity::findOrFail($activityId);
        if (!empty($activity)) {

            if (!empty($activity->activity_zone)) {
             $existed_value = $activity->activity_zone[0]->id;
         }
     }
 }
 $activityZone = $this->activityZoneRepository->getActivityZoneByCountry($country)->toArray();

 return response()->json(['data' => $activityZone,'existed_value'=>$existed_value]);
}

public function changeStatus(Request $request): JsonResponse
{
    $activityId = $request->id;
    $activityDetails = [
        'status' => $request->status,
    ];
    $this->activityRepository->updateActivity($activityId, $activityDetails);

    return response()->json(['success' => 'Status change successfully.']);
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activity = Activity::with([
            'term_activity_lists', 'states', 'attractions', 'languages', 'locations',])->find($id);

        if (empty($activity)) {
            return back();
        }

        if($activity->isEditing()) {
            Session::flash('error','Activity is being Edited. Please wait till its fully edited!');
            return redirect()->Route('admin.activities.index');
        }

        // Set Editing Status
        $activity->edited();

        $data['title'] = 'Activity Edit';
        $data['activity'] = $activity;
        $data = array_merge_recursive($data, $this->_prepareBasicData());
        return view('admin.activities.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateActivityRequest  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateActivityRequest $request, Activity $activity)
    {


        $activityDetails = [

          'name' =>$request->name,
          // 'slug' => SlugService::createSlug(Activity::class, 'slug', $request->name),
          'description' =>$request->description,
          'excerpt' =>$request->excerpt,
          'external_link' =>$request->external_link,
          'address' =>$request->address,
          'price' =>!empty($request->price)?$request->price:0,
          // 'sale_price' =>$request->sale_price,
          // 'child_price' =>$request->child_price,
          // 'disable_children_name' =>$request->disable_children_name,
          // 'hide_children_in_booking_form' =>$request->hide_children_in_booking_form,
          // 'discount_by_child' =>$request->discount_by_child,
          // 'adult_price' =>$request->adult_price,
          // 'hide_adult_in_booking_form' =>$request->hide_adult_in_booking_form,
          // 'discount_by_adult' =>$request->discount_by_adult,
          // 'discount_by_people_type' =>$request->discount_by_people_type,
          // 'calculator_discount_by_people_type' =>$request->calculator_discount_by_people_type,
          // 'infant_price' =>$request->infant_price,
          // 'disable_infant_name' =>$request->disable_infant_name,
          // 'hide_infant_in_booking_form' =>$request->hide_infant_in_booking_form,
          // 'min_price' =>$request->min_price,
          // 'extra_price' =>$request->extra_price,
          'st_activity_external_booking' =>(!empty($request->st_activity_external_booking))?$request->st_activity_external_booking:0,
          'st_activity_external_booking_link' =>$request->st_activity_external_booking_link,
          'deposit_payment_status' =>$request->deposit_payment_status,
          'deposit_payment_amount' =>$request->deposit_payment_amount,
          'type_activity' =>$request->type_activity,
          'rating' =>(!empty($request->rating))?$request->rating:0,
          'activity_booking_period' =>$request->activity_booking_period,
          'min_people' =>(!empty($request->min_people))?$request->min_people:0,
          'max_people' =>(!empty($request->max_people))?$request->max_people:0,
          'duration' =>(!empty($request->duration))?$request->duration:'',
          'is_sale_schedule' =>(!empty($request->is_sale_schedule))?$request->is_sale_schedule:0,
          'discount' =>(!empty($request->discount))?$request->discount:0,
          'sale_price_from' =>$request->sale_price_from,
          'sale_price_to' =>$request->sale_price_to,
          'discount_type' =>$request->discount_type,
          'is_featured' =>$request->is_featured,
          'status' =>$request->status,
          
          //'logo' =>$request->logo,
          'featured_image' =>$request->featured_image,
          'created_by' => (Auth::check())?Auth::user()->id:null,



            // TODO: created_by pending as Authentication is not Yet Completed
      ];
      if (isset($request->activity_program_style)) {
         if ($request->activity_program_style == 'style1' || $request->activity_program_style == 'style3') {
             $request->merge([
                'activity_program_bgr' => [],
            ]);
         }elseif ($request->activity_program_style == 'style2') {
             $request->merge([
                'activity_program' => [],
            ]);
         }

         if (isset($request->activity_zones)) {

            $request->merge([
                'activity_zones' => unsetValueActivityTourismZone($request->activity_zones)
            ]);
        }

        if (empty($request->activity_zone_id)) {

            $request->merge([
                'activity_zone_id' => null
            ]);
        }
    }




    $this->activityRepository->updateActivity($activity->id,$activityDetails);


    if ($activity) {
            // TODO: Move this to Repository

  //   $activityMetaData = [
  //     'map_address',
  //     'latitude',
  //     'longitude',
  //     'zoom_level',
  //     'enable_street_views_google_map',
  //     'gallery',
  //     'video',
  //     'contact',
  //     'venue_facilities',
  //     'activity_include',
  //     'activity_exclude',
  //     'activity_highlight',
  //     'activity_program_style',
  //     'activity_program',
  //     'activity_program_bgr',
  //     'activity_faq',
  //         // 'calendar_check_in',
  //         // 'calendar_check_out',
  //         // 'calendar_adult_price',
  //         // 'calendar_child_price',
  //         // 'calendar_infant_price',
  //         // 'calendar_starttime_hour',
  //         // 'calendar_starttime_minute',
  //         // 'calendar_starttime_format',
  //         // 'calendar_status',
  //         // 'calendar_groupday',
  //         // 'st_allow_cancel',
  //         // 'st_cancel_number_days',
  //         // 'st_cancel_percent',
  //         // 'ical_url',
  //         // 'is_meta_payment_gateway_st_submit_form',
  //     'child_policy',
  //     'booking_policy',
  //     'refund_and_cancellation_policy',
  //     'country',
  //     'st_activity_external_booking_link',
  //     'activity_zones',
  //     'st_activity_corporate_address',
  //     'st_activity_short_address',
  //     'social_links',
  //     'properties_near_by',
  //     'check_editing',

  // ];
       $activity->detail()->update($request->all([
          'map_address',
          'latitude',
          'longitude',
          'zoom_level',
          'enable_street_views_google_map',
          'gallery',
          'video',
          'contact',
          'venue_facilities',
          'activity_include',
          'activity_exclude',
          'activity_highlight',
          'activity_program_style',
          'activity_program',
          'activity_program_bgr',
          'activity_faq',
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
          'child_policy',
          'booking_policy',
          'refund_and_cancellation_policy',
          'country',
          'st_activity_external_booking_link',
          'activity_zones',
          'st_activity_corporate_address',
          'st_activity_short_address',
          'social_links',
          'properties_near_by',
          'check_editing',

      ]));



       $activity->activity_zone()->sync($request->get('activity_zone_id'));
       $activity->attractions()->sync($request->get('attraction'));
       $activity->locations()->sync($request->get('location_id'));
       $activity->languages()->sync($request->get('language'));
       $activity->term_activity_lists()->sync($request->get('term_activity_list'));
       $activity->states()->sync($request->get('state_id'));

            // activitiescard
   }
        // return $activity;
   Session::flash('success','Activity Updated Successfully');
   if(!is_null($request->iscompleted)) {
    $activity->freeEditing();
    return redirect()->Route('admin.activities.index');
}
return redirect()->Route('admin.activities.edit',$activity->id);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {

        $activityId = $id;
        $this->activityRepository->deleteActivity($activityId);
        Session::flash('success','Activity Trashed Successfully');
        return back();
    }


    public function bulk_delete(Request $request)
    {
        if (!empty($request->ids)) {

            $activityIds = get_array_mapping(json_decode($request->ids));
            $this->activityRepository->deleteBulkActivity($activityIds);
            Session::flash('success', 'Activity Bulk Trashed Successfully');
        }
        return back();
    }

    public function trashed_activities(TrashedActivityDataTable $dataTable)
    {

        $trashed_activities = Activity::onlyTrashed()->get();
        $data['trashed_count'] = $trashed_activities->count();
        //$data['trashed_activities'] = $trashed_activities;
        $data['title'] = 'Trash Activity List';
        // dump(Activity::onlyTrashed()->get());
        // dd( $data['trashed']);
        return $dataTable->render('admin.activities.trashed', $data);
    }

    public function restore_activities(Request $request)
    {
        $ids = [];
        if (!empty($request->ids)) {
           $ids =  get_array_mapping(json_decode($request->ids));

       }

       if (!empty($ids)) {
         Activity::whereIn('id',$ids)->withTrashed()->restore();
     }else{
       Activity::onlyTrashed()->restore();
   }
   Session::flash('success','Activity Restored Successfully');
   return redirect()->back();
}

public function restore_activity(Request $request,$id)
{
    $activity = Activity::withTrashed()->find($id);
    if ($activity == null)
    {
        abort(404);
    }

    $activity->restore();
    Session::flash('success','Activity Restored Successfully');
    return redirect()->back();
}
public function bulk_force_delete(Request $request)
{


    if (!empty($request->fd_ids)) {

        $activityIds = get_array_mapping(json_decode($request->fd_ids));
        $this->activityRepository->forceBulkDeleteActivity($activityIds);
        Session::flash('success', 'Activity Bulk Permanent Deleted Successfully');
    }
    return back();
}

public function permanent_delete($id)
{
    $this->activityRepository->forceDeleteActivity($id);
    Session::flash('success','Activity Permanent Deleted Successfully');
    return back();
}
public function empty_trashed(Request $request)
{

    Activity::onlyTrashed()->forceDelete();
    Session::flash('success','Activity Empty Trashed Successfully');
    return redirect()->back();
}

}
