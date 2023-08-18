<?php

namespace App\Http\Controllers;

use App\Interfaces\HotelRepositoryInterface;
use App\Interfaces\FacilityRepositoryInterface;
use App\Interfaces\AmenityRepositoryInterface;
use App\Interfaces\MedicareAssistanceRepositoryInterface;
use App\Interfaces\PlaceRepositoryInterface;
use App\Interfaces\TopServiceRepositoryInterface;
use Illuminate\Http\Request;

class HotelController extends Controller
{

    private HotelRepositoryInterface $hotelRepository;
    private FacilityRepositoryInterface $facilityRepository;
    private AmenityRepositoryInterface $amenityRepository;
    private MedicareAssistanceRepositoryInterface $medicareAssistanceRepository;
    private TopServiceRepositoryInterface $topServiceRepository;
    private PlaceRepositoryInterface $placeRepository;
    

    public function __construct(
        HotelRepositoryInterface $hotelRepository,
        FacilityRepositoryInterface $facilityRepository,
        AmenityRepositoryInterface $amenityRepository,
        MedicareAssistanceRepositoryInterface $medicareAssistanceRepository,
        TopServiceRepositoryInterface $topServiceRepository,
        PlaceRepositoryInterface $placeRepository
        )
    {
        $this->hotelRepository = $hotelRepository;
        $this->facilityRepository = $facilityRepository;
        $this->amenityRepository = $amenityRepository;
        $this->medicareAssistanceRepository = $medicareAssistanceRepository;
        $this->topServiceRepository = $topServiceRepository;
        $this->placeRepository = $placeRepository;
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
            // 'title' => $request->title,
            // 'description' => $request->description
        ];

        $this->hotelRepository->createHotel($hotelDetails);

        // return redirect()->Route('tasks');
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
