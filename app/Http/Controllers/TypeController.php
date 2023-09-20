<?php

namespace App\Http\Controllers;

use App\Interfaces\TypeRepositoryInterface;
use App\Models\Terms\Type;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Session;
use App\DataTables\TypeDataTable;
class TypeController extends Controller
{

       private TypeRepositoryInterface $typeRepository;

    public function __construct(TypeRepositoryInterface $typeRepository)
    {
        $this->typeRepository = $typeRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TypeDataTable $dataTable)
    {
        // $data['types'] = $this->typeRepository->getAllTypes();
        $data['types'] = Type::count();
        $data['title'] = 'Type List';

        return $dataTable->render('admin.terms.types.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Type';
        //$data['types'] = $this->typeRepository->getTypesByType();
        return view('admin.terms.types.create',$data);
    }

        public function getTypesAjax(Request $request): JsonResponse 
    {
        $type = $request->term_type;
        $id = isset($request->id)?$request->id:"";

        $data = [];
        if (isset($type) && !empty($type)) {
             $data = $this->typeRepository->getTypesByType($type,$id);

        }
        return response()->json([
            'data' => $data
        ]);
    }
     public function changeStatus(Request $request): JsonResponse
    {
        $typeId = $request->id;
          $typeDetails = [
            'status' => $request->status,
        ];
        $this->typeRepository->updateType($typeId, $typeDetails);
  
        return response()->json(['success'=>'Status change successfully.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTypeRequest $request)
    {
          $typeDetails = [
            'name' => $request->name,
            'slug' => SlugService::createSlug(Type::class, 'slug', $request->name),
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'type' => $request->type,

            //'attachment' => (isset($request->attachment))?$request->attachment:null,
            // TODO: attachment image ----> S3 Integration
            'lebal_type' => (isset($request->lebal_type))?$request->lebal_type:null,
            'description' => $request->description,
        ];
        $this->typeRepository->createType($typeDetails);
        Session::flash('success','Type Created Successfully');
        return redirect()->Route('admin.terms.types.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        $data['type'] = $type;
        $data['title'] = 'Type';

        if (empty($data['type'])) {
            return back();
        }

        return view('admin.terms.types.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
         $typeId = $type->id;

        $data['type'] = $type;
    
        $data['title'] = 'Type Edit';

        if (empty($data['type'])) {
            return back();
        }
        $data['types'] = $this->typeRepository->getTypesByType($data['type']->type,$typeId);
        return view('admin.terms.types.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTypeRequest  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        $typeId = $type->id;
         
         $typeDetails = [
            'name' => $request->name,
             'slug' => (!empty($request->slug) && $type->slug != $request->slug)?SlugService::createSlug(Type::class, 'slug', $request->slug):$type->slug,
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'type' => $request->type,
             //'attachment' => (isset($request->attachment))?$request->attachment:null,
            // TODO: attachment image ----> S3 Integration
            'lebal_type' => (isset($request->lebal_type))?$request->lebal_type:null,
            'description' => $request->description,
            'status' => $request->status,
        ];

        $this->typeRepository->updateType($typeId, $typeDetails);
         Session::flash('success','Type Updated Successfully');
        return redirect()->Route('admin.terms.types.edit',$typeId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $typeId = $type->id;
        $this->typeRepository->deleteType($typeId);
         Session::flash('success','Type Deleted Successfully');
        return back();
    }

      /**
     * Remove the specified all resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */

     public function bulk_delete(Request $request)
    {
         if (!empty($request->ids)) {
        
        $typeIds = get_array_mapping(json_decode($request->ids));
        $this->typeRepository->deleteBulkType($typeIds);
         Session::flash('success','Type Bulk Deleted Successfully');
        }
        return back();
    }
}
