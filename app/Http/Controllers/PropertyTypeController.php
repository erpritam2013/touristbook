<?php

namespace App\Http\Controllers;
use App\Interfaces\PropertyTypeRepositoryInterface;
use App\Models\Terms\PropertyType;
use App\Http\Requests\StorePropertyTypeRequest;
use App\Http\Requests\UpdatePropertyTypeRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Session;

class PropertyTypeController extends Controller
{

    private PropertyTypeRepositoryInterface $propertyTypeRepository;

    public function __construct(PropertyTypeRepositoryInterface $propertyTypeRepository)
    {
        $this->propertyTypeRepository = $propertyTypeRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data['property_types'] = $this->propertyTypeRepository->getAllPropertyTypes();
        $data['title'] = 'Property Type List';

        return view('admin.terms.property-types.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Accessible';
        //$data['property_types'] = $this->propertyTypeRepository->getPropertyTypesByType();
        return view('admin.terms.property-types.create',$data);
    }

      public function getPropertyTypesAjax(Request $request): JsonResponse 
    {
        $type = $request->property_type_type;
        $id = isset($request->id)?$request->id:"";

        $data = [];
        if (isset($type) && !empty($type)) {
             $data = $this->propertyTypeRepository->getPropertyTypesByType($type,$id);

        }
        return response()->json([
            'data' => $data
        ]);
    }
     public function changeStatus(Request $request): JsonResponse
    {
        $propertyTypeId = $request->id;
          $propertyTypeDetails = [
            'status' => $request->status,
        ];
        $this->propertyTypeRepository->updatePropertyType($propertyTypeId, $propertyTypeDetails);
  
        return response()->json(['success'=>'Status change successfully.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePropertyTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePropertyTypeRequest $request)
    {
        $propertyTypeDetails = [
            'name' => $request->name,
            'slug' => SlugService::createSlug(PropertyType::class, 'slug', $request->name),
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'property_type_type' => $request->property_type_type,
            'description' => $request->description,
            'extra_data' => json_encode($request->extra_data),
        ];
        $this->propertyTypeRepository->createPropertyType($propertyTypeDetails);
        Session::flash('success','Property Type Created Successfully');
        return redirect()->Route('admin.terms.property-types.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PropertyType  $propertyType
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyType $propertyType)
    {
         $data['property_type'] = $propertyType;
        $data['title'] = 'Property Type';

        if (empty($data['property_type'])) {
            return back();
        }

        return view('admin.terms.property-types.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PropertyType  $propertyType
     * @return \Illuminate\Http\Response
     */
    public function edit(PropertyType $propertyType)
    {
        $propertyTypeId = $propertyType->id;

        $data['property_type'] = $propertyType;

        $data['title'] = 'Property Type Edit';

        if (empty($data['property_type'])) {
            return back();
        }
    
        $data['property_types'] = $this->propertyTypeRepository->getPropertyTypesByType($data['property_type']->property_type_type,$propertyTypeId);
        return view('admin.terms.property-types.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePropertyTypeRequest  $request
     * @param  \App\Models\PropertyType  $propertyType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePropertyTypeRequest $request, PropertyType $propertyType)
    {
        $propertyTypeId = $propertyType->id;
         
         $propertyTypeDetails = [
            'name' => $request->name,
            //'slug' => SlugService::createSlug(PropertyType::class, 'slug', $request->name),
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'property_type_type' => $request->property_type_type,
            'description' => $request->description,
            'extra_data' => json_encode($request->extra_data),
            'status' => $request->status,
        ];

        $this->propertyTypeRepository->updatePropertyType($propertyTypeId, $propertyTypeDetails);
         Session::flash('success','Property Type Updated Successfully');
        return redirect()->Route('admin.terms.property-types.edit',$propertyTypeId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PropertyType  $propertyType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertyType $propertyType)
    {
        $propertyTypeId = $propertyType->id;
        $this->propertyTypeRepository->deletePropertyType($propertyTypeId);
         Session::flash('success','Property Type Deleted Successfully');
        return back();
    }

     /**
     * Remove the specified all resource from storage.
     *
     * @param  \App\Models\Accessible  $accessible
     * @return \Illuminate\Http\Response
     */

      public function bulk_delete(Request $request)
    {
         if (!empty($request->ids)) {
        
        $propertyTypeIds = get_array_mapping(json_decode($request->ids));
        $this->propertyTypeRepository->deleteBulkPropertyType($propertyTypeIds);
         Session::flash('success','Property Type Bulk Deleted Successfully');
        }
        return back();
    }
}
