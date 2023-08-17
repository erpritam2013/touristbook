<?php

namespace App\Http\Controllers;

use App\Interfaces\TopServiceRepositoryInterface;
use App\Models\Terms\TopService;
use App\Http\Requests\StoreTopServiceRequest;
use App\Http\Requests\UpdateTopServiceRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Session;

class TopServiceController extends Controller
{

      private TopServiceRepositoryInterface $topserviceRepository;

    public function __construct(TopServiceRepositoryInterface $topserviceRepository)
    {
        $this->topserviceRepository = $topserviceRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data['top_services'] = $this->topserviceRepository->getAllTopServices();
        $data['title'] = 'Top Service List';

        return view('admin.terms.top-services.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Top Service';
        return view('admin.terms.top-services.create',$data);
    }


      public function getTopServicesAjax(Request $request): JsonResponse 
    {
        $type = $request->top_service_type;
        $id = isset($request->id)?$request->id:"";

        $data = [];
        if (isset($type) && !empty($type)) {
             $data = $this->topserviceRepository->getTopServicesByType($type,$id);

        }
        return response()->json([
            'data' => $data
        ]);
    }
     public function changeStatus(Request $request): JsonResponse
    {
        $TopServiceId = $request->id;
          $TopServiceDetails = [
            'status' => $request->status,
        ];
        $this->topserviceRepository->updateTopService($TopServiceId, $TopServiceDetails);
  
        return response()->json(['success'=>'Status change successfully.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTopServiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTopServiceRequest $request)
    {
        $TopServiceDetails = [
            'name' => $request->name,
            'slug' => SlugService::createSlug(TopService::class, 'slug', $request->name),
            'parent_top_service' => (!empty($request->parent_top_service))?$request->parent_top_service:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'top_service_type' => $request->top_service_type,
            'description' => $request->description,
        ];
        $this->topserviceRepository->createTopService($TopServiceDetails);
        Session::flash('success','Top Service Created Successfully');
        return redirect()->Route('admin.terms.top-services.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TopService  $topService
     * @return \Illuminate\Http\Response
     */
    public function show(TopService $topService)
    {
        $data['top_service'] = $topService;
        $data['title'] = 'Top Service';

        if (empty($data['top_service'])) {
            return back();
        }

        return view('admin.terms.top-services.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TopService  $topService
     * @return \Illuminate\Http\Response
     */
    public function edit(TopService $topService)
    {
        $topServiceId = $topService->id;

        $data['top_service'] = $topService;

        $data['title'] = 'Top Service Edit';

        if (empty($data['top_service'])) {
            return back();
        }
        $data['top_services'] = $this->topserviceRepository->getTopServicesByType($data['top_service']->top_service_type,$topServiceId);
        return view('admin.terms.top-services.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTopServiceRequest  $request
     * @param  \App\Models\TopService  $topService
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTopServiceRequest $request, TopService $topService)
    {
         $topServiceId = $topService->id;
         
         $TopServiceDetails = [
            'name' => $request->name,
            //'slug' => SlugService::createSlug(Post::class, 'slug', $request->name),
            'parent_top_service' => (!empty($request->parent_top_service))?$request->parent_top_service:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'top_service_type' => $request->top_service_type,
            'description' => $request->description,
            'status' => $request->status,
        ];

        $this->topserviceRepository->updateTopService($topServiceId, $TopServiceDetails);
         Session::flash('success','Top Service Updated Successfully');
        return redirect()->Route('admin.terms.top-services.edit',$topServiceId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TopService  $topService
     * @return \Illuminate\Http\Response
     */
    public function destroy(TopService $topService)
    {
       $topServiceId = $topService->id;
        $this->topserviceRepository->deleteTopService($topServiceId);
         Session::flash('success','Top Service Deleted Successfully');
        return back();
    }

     public function bulk_delete(Request $request)
    {
         if (!empty($request->ids)) {
        
        $topServiceIds = get_array_mapping(json_decode($request->ids));
        $this->topserviceRepository->deleteBulkTopService($topServiceIds);
         Session::flash('success','Top Service Bulk Deleted Successfully');
        }
        return back();
    }
}
