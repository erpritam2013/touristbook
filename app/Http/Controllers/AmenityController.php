<?php

namespace App\Http\Controllers;
use App\Interfaces\AmenityRepositoryInterface;
use App\Models\Terms\Amenity;
use App\Http\Requests\StoreAmenityRequest;
use App\Http\Requests\UpdateAmenityRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Session;




class AmenityController extends Controller
{


     private AmenityRepositoryInterface $amenityRepository;

    public function __construct(AmenityRepositoryInterface $amenityRepository)
    {
        $this->amenityRepository = $amenityRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data['amenities'] = $this->amenityRepository->getAllAmenities();
        $data['title'] = 'Amenity List';

        return view('admin.terms.amenities.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Amenity';
        //$data['amenities'] = $this->amenityRepository->getAmenitiesByType();
        return view('admin.terms.amenities.create',$data);
    }


      public function getAmenitiesAjax(Request $request): JsonResponse 
    {
        $type = $request->term_type;
        $id = isset($request->id)?$request->id:"";

        $data = [];
        if (isset($type) && !empty($type)) {
             $data = $this->amenityRepository->getAmenitiesByType($type,$id);

        }
        return response()->json([
            'data' => $data
        ]);
    }
     public function changeStatus(Request $request): JsonResponse
    {
        $amenityId = $request->id;
          $amenityDetails = [
            'status' => $request->status,
        ];
        $this->amenityRepository->updateAmenity($amenityId, $amenityDetails);
  
        return response()->json(['success'=>'Status change successfully.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAmenityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAmenityRequest $request)
    {
        $amenityDetails = [
            'name' => $request->name,
            'slug' => SlugService::createSlug(Amenity::class, 'slug', $request->name),
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'amenity_type' => $request->amenity_type,
            'description' => $request->description,
        ];
        $this->amenityRepository->createAmenity($amenityDetails);
        Session::flash('success','Amenity Created Successfully');
        return redirect()->Route('admin.terms.amenities.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Amenity  $amenity
     * @return \Illuminate\Http\Response
     */
    public function show(Amenity $amenity)
    {
        $data['amenity'] = $amenity;
        $data['title'] = 'amenity';

        if (empty($data['amenity'])) {
            return back();
        }

        return view('admin.terms.amenities.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Amenity  $amenity
     * @return \Illuminate\Http\Response
     */
    public function edit(Amenity $amenity)
    {
        $amenityId = $amenity->id;

        $data['amenity'] = $amenity;

        $data['title'] = 'Amenity Edit';

        if (empty($data['amenity'])) {
            return back();
        }
        $data['amenities'] = $this->amenityRepository->getAmenitiesByType($data['amenity']->amenity_type,$amenityId);
        return view('admin.terms.amenities.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAmenityRequest  $request
     * @param  \App\Models\Amenity  $amenity
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAmenityRequest $request, Amenity $amenity)
    {
        $amenityId = $amenity->id;
         
         $amenityDetails = [
            'name' => $request->name,
            //'slug' => SlugService::createSlug(Post::class, 'slug', $request->name),
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'amenity_type' => $request->amenity_type,
            'description' => $request->description,
            'status' => $request->status,
        ];

        $this->amenityRepository->updateAmenity($amenityId, $amenityDetails);
         Session::flash('success','Amenity Updated Successfully');
        return redirect()->Route('admin.terms.amenities.edit',$amenityId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Amenity  $amenity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Amenity $amenity)
    {
        $amenityId = $amenity->id;
        $this->amenityRepository->deleteAmenity($amenityId);
         Session::flash('success','Amenity Deleted Successfully');
        return back();
    }

      /**
     * Remove the specified all resource from storage.
     *
     * @param  \App\Models\Amenity  $amenity
     * @return \Illuminate\Http\Response
     */

     public function bulk_delete(Request $request)
    {
         if (!empty($request->ids)) {
        
        $amenityIds = get_array_mapping(json_decode($request->ids));
        $this->amenityRepository->deleteBulkAmenity($amenityIds);
         Session::flash('success','Amenity Bulk Deleted Successfully');
        }
        return back();
    }
}
