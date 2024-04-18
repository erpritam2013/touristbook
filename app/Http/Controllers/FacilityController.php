<?php

namespace App\Http\Controllers;

use App\Interfaces\FacilityRepositoryInterface;
use App\Models\Terms\Facility;
use App\Http\Requests\StoreFacilityRequest;
use App\Http\Requests\UpdateFacilityRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Session;
use App\DataTables\FacilityDataTable;
class FacilityController extends Controller
{


    private FacilityRepositoryInterface $facilityRepository;

    public function __construct(FacilityRepositoryInterface $facilityRepository)
    {
        $this->facilityRepository = $facilityRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FacilityDataTable $dataTable)
    {
        //$facilities = $this->facilityRepository->getAllFacilities();
        $data['facilities'] = Facility::count();
        $data['title'] = 'Facility List';

        return $dataTable->render('admin.terms.facilities.index', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Facility';
        //$data['facilities'] = $this->facilityRepository->getFacilitiesByType();
        return view('admin.terms.facilities.create',$data);
    }

     public function getFacilitiesAjax(Request $request): JsonResponse
    {
        $type = $request->term_type;
        $id = isset($request->id)?$request->id:"";

        $data = [];
        if (isset($type) && !empty($type)) {
             $data = $this->facilityRepository->getFacilitiesByType($type,$id);

        }
        return response()->json([
            'data' => $data
        ]);
    }

     public function changeStatus(Request $request): JsonResponse
    {
        $facilityId = $request->id;
          $facilityDetails = [
            'status' => $request->status,
        ];
        $this->facilityRepository->updateFacility($facilityId, $facilityDetails);

        return response()->json(['success'=>'Status change successfully.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFacilityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFacilityRequest $request)
    {
         $facilityDetails = [
            'name' => $request->name,
            'slug' => SlugService::createSlug(Facility::class, 'slug', $request->name),
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'facility_type' => $request->facility_type,
            'description' => $request->description,
        ];
        $this->facilityRepository->createFacility($facilityDetails);
        Session::flash('success','Facility Created Successfully');
        return redirect()->Route('admin.terms.facilities.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function show(Facility $facility)
    {
        //$facilityId = $facility->id;

        $data['facility'] = $facility;
        $data['title'] = 'Facility';

        if (empty($data['facility'])) {
            return back();
        }

        return view('admin.terms.facilities.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function edit(Facility $facility)
    {
        $facilityId = $facility->id;

        $data['facility'] = $facility;

        $data['title'] = 'Facility Edit';

        if (empty($data['facility'])) {
            return back();
        }
        $data['facilities'] = $this->facilityRepository->getFacilitiesByType($data['facility']->facility_type,$facilityId);
        return view('admin.terms.facilities.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFacilityRequest  $request
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFacilityRequest $request, Facility $facility)
    {
         $facilityId = $facility->id;

         $facilityDetails = [
            'name' => $request->name,
           'slug' => (!empty($request->slug) && $facility->slug != $request->slug)?SlugService::createSlug(Facility::class, 'slug', $request->slug):$facility->slug,
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'facility_type' => $request->facility_type,
            'description' => $request->description,
            'status' => $request->status,
        ];

        $this->facilityRepository->updateFacility($facilityId, $facilityDetails);
         Session::flash('success','Facility Updated Successfully');
        return redirect()->Route('admin.terms.facilities.edit',$facilityId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facility $facility)
    {
        $facilityId = $facility->id;
        $this->facilityRepository->deleteFacility($facilityId);
         Session::flash('success','Facility Deleted Successfully');
        return back();
    }

    /**
     * Remove the specified all resource from storage.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function bulk_delete(Request $request)
    {
         if (!empty($request->ids)) {

        $facilityIds = get_array_mapping(json_decode($request->ids));
        $this->facilityRepository->deleteBulkFacility($facilityIds);
         Session::flash('success','Facility Bulk Deleted Successfully');
        }
        return back();
    }
}
