<?php

namespace App\Http\Controllers;

use App\Interfaces\PackageTypeRepositoryInterface;
use App\Models\Terms\PackageType;
use App\Http\Requests\StorePackageTypeRequest;
use App\Http\Requests\UpdatePackageTypeRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Session;
use App\DataTables\PackageTypeDataTable;

class PackageTypeController extends Controller
{
    
     private PackageTypeRepositoryInterface $packageTypeRepository;

    public function __construct(PackageTypeRepositoryInterface $packageTypeRepository)
    {
        $this->packageTypeRepository = $packageTypeRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PackageTypeDataTable $dataTable)
    {
        $data['package_types'] = PackageType::count();
        $data['title'] = 'Package Type List';

        return $dataTable->render('admin.terms.package-types.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Package Type';
        //$data['package_types'] = $this->packageTypeRepository->getPackageTypesByType();
        return view('admin.terms.package-types.create',$data);
    }

     public function getPackageTypesAjax(Request $request): JsonResponse 
    {
        $type = $request->term_type;
        $id = isset($request->id)?$request->id:"";

        $data = [];
        if (isset($type) && !empty($type)) {
             $data = $this->packageTypeRepository->getPackageTypesByType($type,$id);

        }
        return response()->json([
            'data' => $data
        ]);
    }
     public function changeStatus(Request $request): JsonResponse
    {
        $packageTypeId = $request->id;
          $packageTypeDetails = [
            'status' => $request->status,
        ];
        $this->packageTypeRepository->updatePackageType($packageTypeId, $packageTypeDetails);
  
        return response()->json(['success'=>'Status change successfully.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePackageTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePackageTypeRequest $request)
    {
        $packageTypeDetails = [
            'name' => $request->name,
            'slug' => SlugService::createSlug(PackageType::class, 'slug', $request->name),
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'package_type_type' => $request->package_type_type,
            'button' => $request->button,
            'extra_data' => $request->extra_data,
            'description' => $request->description,
        ];
        $this->packageTypeRepository->createPackageType($packageTypeDetails);
        Session::flash('success','PackageType Created Successfully');
        return redirect()->Route('admin.terms.package-types.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PackageType  $packageType
     * @return \Illuminate\Http\Response
     */
    public function show(PackageType $packageType)
    {
       $data['package_type'] = $packageType;
        $data['title'] = 'PackageType';

        if (empty($data['package_type'])) {
            return back();
        }

        return view('admin.terms.package-types.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PackageType  $packageType
     * @return \Illuminate\Http\Response
     */
    public function edit(PackageType $packageType)
    {
         $packageTypeId = $packageType->id;

        $data['package_type'] = $packageType;

        $data['title'] = 'Package Type Edit';

        if (empty($data['package_type'])) {
            return back();
        }
        $data['package_types'] = $this->packageTypeRepository->getPackageTypesByType($data['package_type']->package_type_type,$packageTypeId);
        return view('admin.terms.package-types.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePackageTypeRequest  $request
     * @param  \App\Models\PackageType  $packageType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePackageTypeRequest $request, PackageType $packageType)
    {
         
         $packageTypeId = $packageType->id;
         
         $packageTypeDetails = [
            'name' => $request->name,
            'slug' => (!empty($request->slug) && $packageType->slug != $request->slug)?SlugService::createSlug(PackageType::class, 'slug', $request->slug):$packageType->slug,
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'package_type_type' => $request->package_type_type,
            'button' => $request->button,
            'extra_data' => $request->extra_data,
            'description' => $request->description,
            'status' => $request->status,
        ];

        $this->packageTypeRepository->updatePackageType($packageTypeId, $packageTypeDetails);
         Session::flash('success','Package Type Updated Successfully');
        return redirect()->Route('admin.terms.package-types.edit',$packageTypeId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PackageType  $packageType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PackageType $packageType)
    {
         $packageTypeId = $packageType->id;
        $this->packageTypeRepository->deletePackageType($packageTypeId);
         Session::flash('success','Package Type Deleted Successfully');
        return back();
    }

      /**
     * Remove the specified all resource from storage.
     *
     * @param  \App\Models\PackageType  $packageType
     * @return \Illuminate\Http\Response
     */

     public function bulk_delete(Request $request)
    {
         if (!empty($request->ids)) {
        
        $packageTypeIds = get_array_mapping(json_decode($request->ids));
        $this->packageTypeRepository->deleteBulkPackageType($packageTypeIds);
         Session::flash('success','Package Type Bulk Deleted Successfully');
        }
        return back();
    }
}
