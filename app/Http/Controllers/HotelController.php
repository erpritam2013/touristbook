<?php

namespace App\Http\Controllers;

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
use App\Models\Hotel;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class HotelController extends Controller
{

    private HotelRepositoryInterface $hotelRepository;
    private FacilityRepositoryInterface $facilityRepository;
    private AmenityRepositoryInterface $amenityRepository;
    private MedicareAssistanceRepositoryInterface $medicareAssistanceRepository;
    private TopServiceRepositoryInterface $topServiceRepository;
    private PlaceRepositoryInterface $placeRepository;
    private PropertyTypeRepositoryInterface $propertyTypeRepository;
    private AccessibleRepositoryInterface $accessibleRepository;
    private MeetingAndEventRepositoryInterface $meetingAndEventRepository;
    private StateRepositoryInterface $stateRepository;
    private OccupancyRepositoryInterface $occupancyRepository;
    private DealsDiscountRepositoryInterface $dealDiscountRepository;
    private TermActivityRepositoryInterface $activityRepository;


    public function __construct(
        HotelRepositoryInterface $hotelRepository,
        FacilityRepositoryInterface $facilityRepository,
        AmenityRepositoryInterface $amenityRepository,
        MedicareAssistanceRepositoryInterface $medicareAssistanceRepository,
        TopServiceRepositoryInterface $topServiceRepository,
        PlaceRepositoryInterface $placeRepository,
        PropertyTypeRepositoryInterface $propertyTypeRepository,
        AccessibleRepositoryInterface $accessibleRepository,
        MeetingAndEventRepositoryInterface $meetingAndEventRepository,
        StateRepositoryInterface $stateRepository,
        OccupancyRepositoryInterface $occupancyRepository,
        DealsDiscountRepositoryInterface $dealDiscountRepository,
        TermActivityRepositoryInterface $activityRepository
        )
    {
        $this->hotelRepository = $hotelRepository;
        $this->facilityRepository = $facilityRepository;
        $this->amenityRepository = $amenityRepository;
        $this->medicareAssistanceRepository = $medicareAssistanceRepository;
        $this->topServiceRepository = $topServiceRepository;
        $this->placeRepository = $placeRepository;
        $this->propertyTypeRepository = $propertyTypeRepository;
        $this->accessibleRepository = $accessibleRepository;
        $this->meetingAndEventRepository = $meetingAndEventRepository;
        $this->stateRepository = $stateRepository;
        $this->occupancyRepository = $occupancyRepository;
        $this->dealDiscountRepository = $dealDiscountRepository;
        $this->activityRepository = $activityRepository;
    }

    public function index()
    {
        $hotels = $this->hotelRepository->getAllHotels();
        // return view('tasks.index', ['tasks' =>  $tasks]);
    }

    public function create()
    {
        $data['title'] = 'Hotel';
        // TODO: Need to Improve here (Fetch from Cache)
        $data['facilities'] = $this->facilityRepository->getActiveHotelFacilitiesList();
        $data['amenities'] = $this->amenityRepository->getActiveHotelAmenitiesList();
        $data['medicares'] = $this->medicareAssistanceRepository->getActiveHotelMedicareAssistancesList();
        $data['topServices'] = $this->topServiceRepository->getActiveHotelTopServicesList();
        $data['places'] = $this->placeRepository->getActiveHotelPlacesList();
        $data['propertyTypes'] = $this->propertyTypeRepository->getActiveHotelPropertyTypesList();
        $data['accessibles'] = $this->accessibleRepository->getActiveHotelAccessiblesList();
        $data['meetingAndEvents'] = $this->meetingAndEventRepository->getActiveHotelMeetingAndEventsList();
        $data['states'] = $this->stateRepository->getActiveStatesList();
        $data['occupancies'] = $this->occupancyRepository->getActiveHotelOccupanciesList();
        $data['deals'] = $this->dealDiscountRepository->getActiveHotelDealsDiscountsList();
        $data['activities'] = $this->activityRepository->getActiveHotelTermActivitiesList();

        return view('admin.hotels.create', $data);
    }

    public function edit(Request $request)
    {
        $hotelId = $request->route('hotelId');

        $hotel = $this->hotelRepository->getHotelById($hotelId);

        if (empty($hotel)) {
            return back();
        }

        // return view('tasks.edit', ['task' => $task]);
    }

    public function store(Request $request)
    {
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
            'policies' => json_encode($request->policies),
            'notices' => json_encode($request->noticies),
            'status' => $request->status,
            // TODO: created_by pending as Authentication is not Yet Completed
        ];

        $hotel = $this->hotelRepository->createHotel($hotelDetails);

        if($hotel) {
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
        }
        // return $hotel;
        return redirect()->Route('hotels');
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
    public function update(Request $request)
    {
        $hotelId = $request->route('hotelId');

        $hotelDetails = [
            // 'title' => $request->title,
            // 'description' => $request->description
        ];

        $this->hotelRepository->updateHotel($hotelId, $hotelDetails);

        // return redirect()->Route('tasks');
    }

    public function destroy(Request $request)
    {
        $hotelId = $request->route('hotelId');

        $this->hotelRepository->deleteHotel($hotelId);

        return back();
    }

}
