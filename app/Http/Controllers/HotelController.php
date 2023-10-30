<?php

namespace App\Http\Controllers;
use App\Interfaces\LocationRepositoryInterface;
use App\Interfaces\AccessibleRepositoryInterface;
use App\Interfaces\HotelRepositoryInterface;
use App\Interfaces\FacilityRepositoryInterface;
use App\Interfaces\AmenityRepositoryInterface;
use App\Interfaces\DealsDiscountRepositoryInterface;
use App\Interfaces\MedicareAssistanceRepositoryInterface;
use App\Interfaces\MeetingAndEventRepositoryInterface;
use App\Interfaces\OccupancyRepositoryInterface;
use App\Interfaces\PlaceRepositoryInterface;
use App\Interfaces\PropertyTypeRepositoryInterface;
use App\Interfaces\StateRepositoryInterface;
use App\Interfaces\TermActivityRepositoryInterface;
use App\Interfaces\TopServiceRepositoryInterface;
use App\Http\Requests\StoreHotelRequest;
use App\Http\Requests\UpdateHotelRequest;
use App\Models\Hotel;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\DataTables\HotelDataTable;
use Session;

class HotelController extends Controller
{




    private LocationRepositoryInterface $locationRepository;
    private HotelRepositoryInterface $hotelRepository;
    private FacilityRepositoryInterface $facilityRepository;
    private AmenityRepositoryInterface $amenityRepository;
    private MedicareAssistanceRepositoryInterface $medicareAssistanceRepository;
    private TopServiceRepositoryInterface $topServiceRepository;
    private PlaceRepositoryInterface $placeRepository;
    private StateRepositoryInterface $stateRepository;
    private PropertyTypeRepositoryInterface $propertyTypeRepository;
    private AccessibleRepositoryInterface $accessibleRepository;
    private MeetingAndEventRepositoryInterface $meetingAndEventRepository;
    private OccupancyRepositoryInterface $occupancyRepository;
    private DealsDiscountRepositoryInterface $dealDiscountRepository;
    private TermActivityRepositoryInterface $activityRepository;


    public function __construct(
        HotelRepositoryInterface $hotelRepository,
        LocationRepositoryInterface $locationRepository,
        FacilityRepositoryInterface $facilityRepository,
        AmenityRepositoryInterface $amenityRepository,
        MedicareAssistanceRepositoryInterface $medicareAssistanceRepository,
        TopServiceRepositoryInterface $topServiceRepository,
        PlaceRepositoryInterface $placeRepository,
        StateRepositoryInterface $stateRepository,
        PropertyTypeRepositoryInterface $propertyTypeRepository,
        AccessibleRepositoryInterface $accessibleRepository,
        MeetingAndEventRepositoryInterface $meetingAndEventRepository,
        OccupancyRepositoryInterface $occupancyRepository,
        DealsDiscountRepositoryInterface $dealDiscountRepository,
        TermActivityRepositoryInterface $activityRepository
    ) {
        $this->locationRepository = $locationRepository;
        $this->hotelRepository = $hotelRepository;
        $this->facilityRepository = $facilityRepository;
        $this->amenityRepository = $amenityRepository;
        $this->medicareAssistanceRepository = $medicareAssistanceRepository;
        $this->topServiceRepository = $topServiceRepository;
        $this->placeRepository = $placeRepository;
        $this->stateRepository = $stateRepository;
        $this->propertyTypeRepository = $propertyTypeRepository;
        $this->accessibleRepository = $accessibleRepository;
        $this->meetingAndEventRepository = $meetingAndEventRepository;
        $this->occupancyRepository = $occupancyRepository;
        $this->dealDiscountRepository = $dealDiscountRepository;
        $this->activityRepository = $activityRepository;
    }

    private function _prepareBasicData() {

        // TODO: Need to Improve here (Fetch from Cache)
        $data['facilities'] = $this->facilityRepository->getActiveHotelFacilitiesList();
        $data['amenities'] = $this->amenityRepository->getActiveHotelAmenitiesList();
        $data['medicares'] = $this->medicareAssistanceRepository->getActiveHotelMedicareAssistancesList();
        $data['topServices'] = $this->topServiceRepository->getActiveHotelTopServicesList();
        $data['places'] = $this->placeRepository->getActiveHotelPlacesList();
        $data['propertyTypes'] = $this->propertyTypeRepository->getActiveHotelPropertyTypesList();
        $data['accessibles'] = $this->accessibleRepository->getActiveHotelAccessiblesList();
        $data['meetingAndEvents'] = $this->meetingAndEventRepository->getActiveHotelMeetingAndEventsList();
        $data['locations'] = $this->locationRepository->getActiveLocationsList();

        $data['states'] = $this->stateRepository->getActiveStatesList()->map(function($value, $key){
            return (object)[
                'id' => $value->id,
                'value' => $value->name,
                'parent_id' => $value->name,
            ];
        });
        $data['occupancies'] = $this->occupancyRepository->getActiveHotelOccupanciesList();
        $data['deals'] = $this->dealDiscountRepository->getActiveHotelDealsDiscountsList();
        $data['activities'] = $this->activityRepository->getActiveHotelTermActivitiesList();

        return $data;

    }

    public function index(HotelDataTable $dataTable)
    {
        $data['hotels'] = Hotel::count();
        $data['title'] = 'Hotel List';
        return $dataTable->render('admin.hotels.index', $data);
    }


    public function create()
    {
        $data['title'] = 'Hotel';
        $data['hotel'] = new Hotel();
        $data = array_merge_recursive($data, $this->_prepareBasicData());

        return view('admin.hotels.create', $data);
    }

    public function edit($id)
    {
        $hotel = Hotel::with([
            'facilities', 'amenities', 'medicare_assistances', 'top_services', 'places',
            'propertyTypes',
            'accessibles', 'meetingEvents', 'states', 'occupancies', 'deals', 'activities',
            'detail'
        ])->find($id);

        if (empty($hotel)) {
            return back();
        }

        $data['title'] = 'Hotel';
        $data['hotel'] = $hotel;
        $data = array_merge_recursive($data, $this->_prepareBasicData());
        return view('admin.hotels.edit', $data);
    }

    public function store(StoreHotelRequest $request)
    {
        // dd($request->all());
        $images = json_decode($request->images);
        $hotelDetails = [
            'name' => $request->name,
            'description' => $request->description,
            'slug' => SlugService::createSlug(Hotel::class, 'slug', $request->name),
            'external_link' => $request->external_link,
            'food_dining' => $request->food_dining,
            'is_featured' => $request->is_featured,
            // TODO: logo and featured_image ----> S3 Integration
            'featured_image' => $request->featured_image,
            'hotel_video' => $request->hotel_video,
            'rating' => $request->rating,
            'coupon_code' => $request->coupon_code,
            'hotel_attributes' => $request->hotel_attributes,
            'contact' => $request->contact,
            'address' => $request->address,
            'avg_price' => (float)$request->avg_price,
            'is_allowed_full_day' => $request->is_allowed_full_day,
            // TODO: check_in, check_out jquery plugin for time setup
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'book_before_day' => $request->book_before_day,
            'book_before_arrival' => $request->book_before_arrival,
            'policies' => $request->policy,
            'notices' => $request->notices,
            'status' => $request->status,
            'images' => $images
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
                'social_links',
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
            $hotel->activities()->attach($request->get('activitiescard'));
            $hotel->locations()->attach($request->get('location_id'));
            // activitiescard
        }
        // return $hotel;
        Session::flash('success','Hotel Created Successfully');
        return redirect()->Route('admin.hotels.index');
    }

    public function changeStatus(Request $request): JsonResponse
    {
        $hotelId = $request->id;
        $hotelDetails = [
            'status' => $request->status,
        ];
        $this->hotelRepository->updateHotel($hotelId, $hotelDetails);

        return response()->json(['success' => 'Status change successfully.']);
    }

    public function show(Request $request)
    {
        $hotelId = $request->route('hotelId');

        $hotel = $this->hotelRepository->getHotelById($hotelId);

        if (empty($hotel)) {
            return back();
        }

        // return view('tasks.show', ['task' => $task]);
    }
    public function update(UpdateHotelRequest $request, Hotel $hotel)
    {

       
        $images = json_decode($request->images);
        $hotelDetails = [
            'name' => $request->name,
            'description' => $request->description,
           // 'slug' => (!empty($request->slug) && $hotel->slug != $request->slug)?SlugService::createSlug(Hotel::class, 'slug', $request->slug):$hotel->slug,
            'external_link' => $request->external_link,
            'food_dining' => $request->food_dining,
            'is_featured' => $request->is_featured,
            // TODO: logo and featured_image ----> S3 Integration
            'featured_image' => $request->featured_image,
            'hotel_video' => $request->hotel_video,
            'rating' => $request->rating,
            'coupon_code' => $request->coupon_code,
            'hotel_attributes' => $request->hotel_attributes,
            'contact' => $request->contact,
            'address' => $request->address,
            'avg_price' => (float)$request->avg_price,
            'is_allowed_full_day' => $request->is_allowed_full_day,
            // TODO: check_in, check_out jquery plugin for time setup
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'book_before_day' => $request->book_before_day,
            'book_before_arrival' => $request->book_before_arrival,
            'policies' => $request->policy,
            'notices' => $request->notices,
            'status' => $request->status,
            'images' => $images
            // TODO: created_by pending as Authentication is not Yet Completed
        ];

        $this->hotelRepository->updateHotel($hotel->id, $hotelDetails);

        if ($hotel) {
            // TODO: Move this to Repository
            $hotel->detail()->update($request->only([
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
                'social_links',
                'activities',
                'room_amenities',
                'transport',
                'payment_mode',
                'id_proofs',
                'emergencyLinks',
            ]));


            $hotel->facilities()->sync($request->get('facilities'));
            $hotel->amenities()->sync($request->get('amenities'));
            $hotel->medicare_assistances()->sync($request->get('medicares'));
            $hotel->top_services()->sync($request->get('topServices'));
            $hotel->places()->sync($request->get('places'));
            $hotel->propertyTypes()->sync($request->get('propertyTypes'));
            $hotel->accessibles()->sync($request->get('accessibles'));
            $hotel->meetingEvents()->sync($request->get('meetingAndEvents'));
            $hotel->states()->sync($request->get('state_id'));
            $hotel->occupancies()->sync($request->get('occupancies'));
            $hotel->deals()->sync($request->get('deals'));
            $hotel->activities()->sync($request->get('activitiescard'));
            $hotel->locations()->sync($request->get('location_id'));
            // activitiescard
        }
        // return $hotel;
        Session::flash('success','Hotel Created Successfully');
        return redirect()->Route('admin.hotels.edit',$hotel->id);
    }

    public function destroy(Hotel $hotel)
    {
        $hotelId = $hotel->id;

        $this->hotelRepository->deleteHotel($hotelId);
        Session::flash('success','Hotel Deleted Successfully');
        return back();
    }


    public function bulk_delete(Request $request)
    {
        if (!empty($request->ids)) {

            $hotelIds = get_array_mapping(json_decode($request->ids));
            $this->hotelRepository->deleteBulkHotel($hotelIds);
            Session::flash('success', 'Hotel Bulk Deleted Successfully');
        }
        return back();
    }
}
