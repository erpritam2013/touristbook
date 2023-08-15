<?php

namespace App\Http\Controllers;

use App\Interfaces\HotelRepositoryInterface;
use Illuminate\Http\Request;

class HotelController extends Controller
{

    private HotelRepositoryInterface $hotelRepository;

    public function __construct(HotelRepositoryInterface $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }

    public function index()
    {
        $tasks = $this->hotelRepository->getAllHotels();

        // return view('tasks.index', ['tasks' =>  $tasks]);
    }

    public function create()
    {
        // return view('tasks.create');
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
