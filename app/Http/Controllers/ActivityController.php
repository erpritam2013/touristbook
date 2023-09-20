<?php

namespace App\Http\Controllers;

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
use Session;

class ActivityController extends Controller
{


    private TermActivityListRepositoryInterface $termActivityListRepository;
    private StateRepositoryInterface $stateRepository;
    private AttractionRepositoryInterface $attractionRepository;
    private LanguageRepositoryInterface $languageRepository;

    public function __construct(
        TermActivityListRepositoryInterface $termActivityListRepository,
        StateRepositoryInterface $stateRepository,
        AttractionRepositoryInterface $attractionRepository,
        LanguageRepositoryInterface $languageRepository
       
    ) {
        $this->termActivityListRepository = $termActivityListRepository;
        $this->stateRepository = $stateRepository;
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
        return $data;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ActivityDataTable $dataTable)
    {
        $data['activities'] = Activity::count();
        $data['title'] = 'Activity List';
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

        dd($request->all());
        $hotelDetails = [
            'name' => $request->name,
            'description' => $request->description,
            'slug' => SlugService::createSlug(Hotel::class, 'slug', $request->name),
            'external_link' => $request->external_link,
            'food_dining' => $request->food_dining,
            'is_featured' => $request->is_featured,
            // TODO: logo and featured_image ----> S3 Integration
            'hotel_video' => $request->hotel_video,
            'rating' => $request->rating,
            'coupon_code' => $request->coupon_code,
            'hotel_attributes' => $request->hotel_attributes,
            'contact' => $request->contact,
            'avg_price' => (float)$request->avg_price,
            'is_allowed_full_day' => $request->is_allowed_full_day,
            // TODO: check_in, check_out jquery plugin for time setup
            // 'check_in' => $request->check_in,
            // 'check_out' => $request->check_out,
            'book_before_day' => $request->book_before_day,
            'book_before_arrival' => $request->book_before_arrival,
            'policies' => $request->policy,
            'notices' => $request->noticies,
            'status' => $request->status,
            // TODO: created_by pending as Authentication is not Yet Completed
        ];

        $hotel = $this->hotelRepository->createHotel($hotelDetails);

        if ($hotel) {
            // TODO: Move this to Repository
            $hotel->detail()->create($request->only([
                'map_address',
                'latitude',
                'longitude',
                'zoom_level',
                'highlights',
                'facilityAmenities',
                'foods',
                'drinks',
                'complimentary',
                'helpfulfacts',
                'save_pocket',
                'pocketPDF',
                'save_environment',
                'landmark',
                'todo',
                'offers',
                'todovideo',
                'eventmeeting',
                'tourism_zone',
                'tourism_zone_heading',
                'tourismzonepdf',
                'activities',
                'room_amenities',
                'transport',
                'payment_mode',
                'id_proofs',
                'emergencyLinks',
            ]));


            $hotel->facilities()->attach($request->get('facilities'));
            $hotel->amenities()->attach($request->get('amenities'));
            $hotel->medicare_assistances()->attach($request->get('medicares'));
            $hotel->top_services()->attach($request->get('topServices'));
            $hotel->places()->attach($request->get('places'));
            $hotel->propertyTypes()->attach($request->get('propertyTypes'));
            $hotel->accessibles()->attach($request->get('accessibles'));
            $hotel->meetingEvents()->attach($request->get('meetingAndEvents'));
            $hotel->states()->attach($request->get('state_id'));
            $hotel->occupancies()->attach($request->get('occupancies'));
            $hotel->deals()->attach($request->get('deals'));
            $hotel->activities()->attach($request->get('activities'));
            // activitiescard
        }
        // return $hotel;
        Session::flash('success','Hotel Created Successfully');
        return redirect()->Route('admin.hotels.index');
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
    public function edit(Activity $activity)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
