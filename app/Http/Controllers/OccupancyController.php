<?php

namespace App\Http\Controllers;

use App\Interfaces\OccupancyRepositoryInterface;
use App\Models\Terms\Occupancy;
use App\Http\Requests\StoreOccupancyRequest;
use App\Http\Requests\UpdateOccupancyRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Session;
use App\DataTables\OccupancyDataTable;
class OccupancyController extends Controller
{ 
    private OccupancyRepositoryInterface $OccupancyRepository;

    public function __construct(OccupancyRepositoryInterface $OccupancyRepository)
    {
        $this->OccupancyRepository = $OccupancyRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OccupancyDataTable $dataTable)
    {
        // $data['occupancies'] = $this->OccupancyRepository->getAllOccupancies();
        $data['occupancies'] = Occupancy::count();
        $data['title'] = 'Occupancy List';

        return $dataTable->render('admin.terms.occupancies.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $data['title'] = 'Add Occupancy';
        //$data['occupancies'] = $this->OccupancyRepository->getOccupanciesByType();
        return view('admin.terms.occupancies.create',$data);
    }

     public function getOccupanciesAjax(Request $request): JsonResponse 
    {
        $type = $request->term_type;
        $id = isset($request->id)?$request->id:"";

        $data = [];
        if (isset($type) && !empty($type)) {
             $data = $this->OccupancyRepository->getOccupanciesByType($type,$id);

        }
        return response()->json([
            'data' => $data
        ]);
    }

     public function changeStatus(Request $request): JsonResponse
    {
        $OccupancyId = $request->id;
          $OccupancyDetails = [
            'status' => $request->status,
        ];
        $this->OccupancyRepository->updateOccupancy($OccupancyId, $OccupancyDetails);
  
        return response()->json(['success'=>'Status change successfully.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOccupancyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOccupancyRequest $request)
    {
        $OccupancyDetails = [
            'name' => $request->name,
            'slug' => SlugService::createSlug(Occupancy::class, 'slug', $request->name),
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'occupancy_type' => $request->occupancy_type,
            'description' => $request->description,
        ];
        $this->OccupancyRepository->createOccupancy($OccupancyDetails);
        Session::flash('success','Occupancy Created Successfully');
        return redirect()->Route('admin.terms.occupancies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Occupancy  $occupancy
     * @return \Illuminate\Http\Response
     */
    public function show(Occupancy $occupancy)
    {
        //$OccupancyId = $occupancy->id;

        $data['occupancy'] = $occupancy;
        $data['title'] = 'occupancy';

        if (empty($data['occupancy'])) {
            return back();
        }

        return view('admin.terms.occupancies.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Occupancy  $occupancy
     * @return \Illuminate\Http\Response
     */
    public function edit(Occupancy $occupancy)
    {
       $OccupancyId = $occupancy->id;

        $data['occupancy'] = $occupancy;

        $data['title'] = 'Occupancy Edit';

        if (empty($data['occupancy'])) {
            return back();
        }
        $data['occupancies'] = $this->OccupancyRepository->getOccupanciesByType($data['occupancy']->occupancy_type,$OccupancyId);
        return view('admin.terms.occupancies.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOccupancyRequest  $request
     * @param  \App\Models\Occupancy  $occupancy
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOccupancyRequest $request, Occupancy $occupancy)
    {
        $OccupancyId = $occupancy->id;
         
         $occupancyDetails = [
            'name' => $request->name,
            //'slug' => SlugService::createSlug(Post::class, 'slug', $request->name),
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'occupancy_type' => $request->occupancy_type,
            'description' => $request->description,
            'status' => $request->status,
        ];

        $this->OccupancyRepository->updateoccupancy($OccupancyId, $occupancyDetails);
         Session::flash('success','Occupancy Updated Successfully');
        return redirect()->Route('admin.terms.occupancies.edit',$OccupancyId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Occupancy  $occupancy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Occupancy $occupancy)
    {
        $OccupancyId = $occupancy->id;
        $this->OccupancyRepository->deleteOccupancy($OccupancyId);
         Session::flash('success','Occupancy Deleted Successfully');
        return back();
    }
    /**
     * Remove the specified all resource from storage.
     *
     * @param  \App\Models\Occupancy  $occupancy
     * @return \Illuminate\Http\Response
     */
    public function bulk_delete(Request $request)
    {
         if (!empty($request->ids)) {
        
        $OccupancyIds = get_array_mapping(json_decode($request->ids));
        $this->OccupancyRepository->deleteBulkOccupancy($OccupancyIds);
         Session::flash('success','Occupancy Bulk Deleted Successfully');
        }
        return back();
    }
}
