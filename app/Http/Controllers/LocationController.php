<?php

namespace App\Http\Controllers;

use App\Interfaces\PlaceRepositoryInterface;
use App\Interfaces\StateRepositoryInterface;
use App\Interfaces\TypeRepositoryInterface;
use App\Models\Location;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;

class LocationController extends Controller
{

  private PlaceRepositoryInterface $placeRepository;
  private StateRepositoryInterface $stateRepository;
  private TypeRepositoryInterface $typeRepository;

  public function __construct(
    PlaceRepositoryInterface $placeRepository,
    StateRepositoryInterface $stateRepository,
    TypeRepositoryInterface $typeRepository,

)
  {
    $this->placeRepository = $placeRepository;
    $this->stateRepository = $stateRepository;
    $this->typeRepository = $typeRepository;

}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $data['title'] = 'Hotel';
        // TODO: Need to Improve here (Fetch from Cache)
        $data['places'] = $this->placeRepository->getActiveLocationPlacesList();
        $data['states'] = $this->stateRepository->getActiveStatesList();
        $data['types'] = $this->typeRepository->getActiveLocationTypesList();
        
        return view('admin.locations.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLocationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLocationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLocationRequest  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocationRequest $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        //
    }
}
