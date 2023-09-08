<?php

namespace App\Http\Controllers;
use App\Interfaces\AccessibleRepositoryInterface;
use App\Models\Terms\Accessible;
use App\Http\Requests\StoreAccessibleRequest;
use App\Http\Requests\UpdateAccessibleRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Session;
use App\DataTables\AccessibleDataTable;
class AccessibleController extends Controller
{

      private AccessibleRepositoryInterface $accessibleRepository;

    public function __construct(AccessibleRepositoryInterface $accessibleRepository)
    {
        $this->accessibleRepository = $accessibleRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AccessibleDataTable $dataTable)
    {
        // $data['accessibles'] = $this->accessibleRepository->getAllAccessibles();
        $data['accessibles'] = Accessible::count();
        $data['title'] = 'Accessible List';

        return $dataTable->render('admin.terms.accessibles.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Accessible';
        //$data['accessibles'] = $this->accessibleRepository->getAccessiblesByType();
        return view('admin.terms.accessibles.create',$data);
    }

    public function getAccessiblesAjax(Request $request): JsonResponse 
    {
        $type = $request->accessible_type;
        $id = isset($request->id)?$request->id:"";

        $data = [];
        if (isset($type) && !empty($type)) {
             $data = $this->accessibleRepository->getAccessiblesByType($type,$id);

        }
        return response()->json([
            'data' => $data
        ]);
    }
     public function changeStatus(Request $request): JsonResponse
    {
        $accessibleId = $request->id;
          $accessibleDetails = [
            'status' => $request->status,
        ];
        $this->accessibleRepository->updateAccessible($accessibleId, $accessibleDetails);
  
        return response()->json(['success'=>'Status change successfully.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAccessibleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccessibleRequest $request)
    {
        $accessibleDetails = [
            'name' => $request->name,
            'slug' => SlugService::createSlug(Accessible::class, 'slug', $request->name),
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'accessible_type' => $request->accessible_type,
            'description' => $request->description,
        ];
        $this->accessibleRepository->createAccessible($accessibleDetails);
        Session::flash('success','Accessible Created Successfully');
        return redirect()->Route('admin.terms.accessibles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Accessible  $accessible
     * @return \Illuminate\Http\Response
     */
    public function show(Accessible $accessible)
    {
         $data['accessible'] = $accessible;
        $data['title'] = 'accessible';

        if (empty($data['accessible'])) {
            return back();
        }

        return view('admin.terms.accessibles.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Accessible  $accessible
     * @return \Illuminate\Http\Response
     */
    public function edit(Accessible $accessible)
    {
        $accessibleId = $accessible->id;

        $data['accessible'] = $accessible;

        $data['title'] = 'Accessible Edit';

        if (empty($data['accessible'])) {
            return back();
        }
        $data['accessibles'] = $this->accessibleRepository->getAccessiblesByType($data['accessible']->accessible_type,$accessibleId);
        return view('admin.terms.accessibles.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAccessibleRequest  $request
     * @param  \App\Models\Accessible  $accessible
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccessibleRequest $request, Accessible $accessible)
    {
         $accessibleId = $accessible->id;
         
         $accessibleDetails = [
            'name' => $request->name,
            //'slug' => SlugService::createSlug(Post::class, 'slug', $request->name),
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'accessible_type' => $request->accessible_type,
            'description' => $request->description,
            'status' => $request->status,
        ];

        $this->accessibleRepository->updateAccessible($accessibleId, $accessibleDetails);
         Session::flash('success','Accessible Updated Successfully');
        return redirect()->Route('admin.terms.accessibles.edit',$accessibleId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Accessible  $accessible
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accessible $accessible)
    {
        $accessibleId = $accessible->id;
        $this->accessibleRepository->deleteAccessible($accessibleId);
         Session::flash('success','Accessible Deleted Successfully');
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
        
        $accessibleIds = get_array_mapping(json_decode($request->ids));
        $this->accessibleRepository->deleteBulkAccessible($accessibleIds);
         Session::flash('success','Accessible Bulk Deleted Successfully');
        }
        return back();
    }
}
