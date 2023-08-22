<?php

namespace App\Http\Controllers;

use App\Interfaces\PlaceRepositoryInterface;
use App\Models\Terms\Place;
use App\Http\Requests\StorePlaceRequest;
use App\Http\Requests\UpdatePlaceRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Session;

class PlaceController extends Controller
{

      private PlaceRepositoryInterface $PlaceRepository;

    public function __construct(PlaceRepositoryInterface $placeRepository)
    {
        $this->placeRepository = $placeRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['places'] = $this->placeRepository->getAllPlaces();
        $data['title'] = 'Place List';

        return view('admin.terms.places.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $data['title'] = 'Add Place';
        //$data['places'] = $this->placeRepository->getPlacesByType();
        return view('admin.terms.places.create',$data);
    }

    public function getPlacesAjax(Request $request): JsonResponse 
    {
        $type = $request->term_type;
        $id = isset($request->id)?$request->id:"";

        $data = [];
        if (isset($type) && !empty($type)) {
             $data = $this->placeRepository->getPlacesByType($type,$id);

        }
        return response()->json([
            'data' => $data
        ]);
    }
     public function changeStatus(Request $request): JsonResponse
    {
        $placeId = $request->id;
          $placeDetails = [
            'status' => $request->status,
        ];
        $this->placeRepository->updatePlace($placeId, $placeDetails);
  
        return response()->json(['success'=>'Status change successfully.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePlaceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlaceRequest $request)
    {
        $placeDetails = [
            'name' => $request->name,
            'slug' => SlugService::createSlug(Place::class, 'slug', $request->name),
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'place_type' => $request->place_type,
            'description' => $request->description,
        ];
        $this->placeRepository->createPlace($placeDetails);
        Session::flash('success','Place Created Successfully');
        return redirect()->Route('admin.terms.places.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place)
    {
         $data['place'] = $place;
        $data['title'] = 'place';

        if (empty($data['place'])) {
            return back();
        }

        return view('admin.terms.places.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function edit(Place $place)
    {
       $placeId = $place->id;

        $data['place'] = $place;

        $data['title'] = 'Place Edit';

        if (empty($data['place'])) {
            return back();
        }
        $data['places'] = $this->placeRepository->getPlacesByType($data['place']->place_type,$placeId);
        return view('admin.terms.places.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePlaceRequest  $request
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlaceRequest $request, Place $place)
    {
         $placeId = $place->id;
         
         $placeDetails = [
            'name' => $request->name,
            //'slug' => SlugService::createSlug(Place::class, 'slug', $request->name),
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'place_type' => $request->place_type,
            'description' => $request->description,
            'status' => $request->status,
        ];

        $this->placeRepository->updatePlace($placeId, $placeDetails);
         Session::flash('success','Place Updated Successfully');
        return redirect()->Route('admin.terms.places.edit',$placeId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
        $placeId = $place->id;
        $this->placeRepository->deletePlace($placeId);
         Session::flash('success','Place Deleted Successfully');
        return back();
    }

    /**
     * Remove the specified all resource from storage.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */

     public function bulk_delete(Request $request)
    {
         if (!empty($request->ids)) {
        
        $placeIds = get_array_mapping(json_decode($request->ids));
        $this->placeRepository->deleteBulkPlace($placeIds);
         Session::flash('success','Place Bulk Deleted Successfully');
        }
        return back();
    }
}
