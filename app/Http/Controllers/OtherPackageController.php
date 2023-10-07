<?php

namespace App\Http\Controllers;
use App\Interfaces\CountryRepositoryInterface;
use App\Interfaces\OtherPackageRepositoryInterface;
use App\Models\Terms\OtherPackage;
use App\Http\Requests\StoreOtherPackageRequest;
use App\Http\Requests\UpdateOtherPackageRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Session;
use App\DataTables\OtherPackageDataTable;

class OtherPackageController extends Controller
{
    
     private OtherPackageRepositoryInterface $otherPackageRepository;
 private CountryRepositoryInterface $countryRepository;
    

    public function __construct(OtherPackageRepositoryInterface $otherPackageRepository,CountryRepositoryInterface $countryRepository)
    {
        $this->otherPackageRepository = $otherPackageRepository;
        $this->countryRepository = $countryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OtherPackageDataTable $dataTable)
    {
        $data['other_packages'] = OtherPackage::count();
        $data['title'] = 'Other Package List';

        return $dataTable->render('admin.terms.other-packages.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Other Package';
        $data['countries'] = $this->countryRepository->getCountiesList();
        return view('admin.terms.other-packages.create',$data);
    }

     public function getOtherPackagesAjax(Request $request): JsonResponse 
    {
        $type = $request->term_type;
        $id = isset($request->id)?$request->id:"";

        $data = [];
        if (isset($type) && !empty($type)) {
             $data = $this->otherPackageRepository->getOtherPackagesByType($type,$id);

        }
        return response()->json([
            'data' => $data
        ]);
    }
     public function changeStatus(Request $request): JsonResponse
    {
        $otherPackageId = $request->id;
          $otherPackageDetails = [
            'status' => $request->status,
        ];
        $this->otherPackageRepository->updateOtherPackage($otherPackageId, $otherPackageDetails);
  
        return response()->json(['success'=>'Status change successfully.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOtherPackageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOtherPackageRequest $request)
    {
        $otherPackageDetails = [
            'name' => $request->name,
            'slug' => SlugService::createSlug(OtherPackage::class, 'slug', $request->name),
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'other_package_type' => $request->other_package_type,
            'button' => $request->button,
            'extra_data' => $request->extra_data,
            'country' => $request->country,
            'description' => $request->description,
        ];
        $this->otherPackageRepository->createOtherPackage($otherPackageDetails);
        Session::flash('success','Other Package Created Successfully');
        return redirect()->Route('admin.terms.other-packages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OtherPackage  $otherPackage
     * @return \Illuminate\Http\Response
     */
    public function show(OtherPackage $otherPackage)
    {
       $data['other_package'] = $otherPackage;
        $data['title'] = 'Other Package';

        if (empty($data['other_package'])) {
            return back();
        }

        return view('admin.terms.other-packages.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OtherPackage  $otherPackage
     * @return \Illuminate\Http\Response
     */
    public function edit(OtherPackage $otherPackage)
    {
         $otherPackageId = $otherPackage->id;

        $data['other_package'] = $otherPackage;

        $data['title'] = 'Other Package Edit';

        if (empty($data['other_package'])) {
            return back();
        }
        $data['countries'] = $this->countryRepository->getCountiesList();
        $data['other_packages'] = $this->otherPackageRepository->getOtherPackagesByType($data['other_package']->other_package_type,$otherPackageId);
        return view('admin.terms.other-packages.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOtherPackageRequest  $request
     * @param  \App\Models\OtherPackage  $otherPackage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOtherPackageRequest $request, OtherPackage $otherPackage)
    {
         
         $otherPackageId = $otherPackage->id;
         
         $otherPackageDetails = [
            'name' => $request->name,
            'slug' => (!empty($request->slug) && $otherPackage->slug != $request->slug)?SlugService::createSlug(OtherPackage::class, 'slug', $request->slug):$otherPackage->slug,
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'other_package_type' => $request->other_package_type,
            'button' => $request->button,
            'extra_data' => $request->extra_data,
            'country' => $request->country,
            'description' => $request->description,
            'status' => $request->status,
        ];

        $this->otherPackageRepository->updateOtherPackage($otherPackageId, $otherPackageDetails);
         Session::flash('success','Other Package Updated Successfully');
        return redirect()->Route('admin.terms.other-packages.edit',$otherPackageId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OtherPackage  $otherPackage
     * @return \Illuminate\Http\Response
     */
    public function destroy(OtherPackage $otherPackage)
    {
         $otherPackageId = $otherPackage->id;
        $this->otherPackageRepository->deleteOtherPackage($otherPackageId);
         Session::flash('success','Other Package Deleted Successfully');
        return back();
    }

      /**
     * Remove the specified all resource from storage.
     *
     * @param  \App\Models\OtherPackage  $otherPackage
     * @return \Illuminate\Http\Response
     */

     public function bulk_delete(Request $request)
    {
         if (!empty($request->ids)) {
        
        $otherPackageIds = get_array_mapping(json_decode($request->ids));
        $this->otherPackageRepository->deleteBulkOtherPackage($otherPackageIds);
         Session::flash('success','Other Package Bulk Deleted Successfully');
        }
        return back();
    }
}
