<?php

namespace App\Http\Controllers;

use App\Interfaces\AttractionRepositoryInterface;
use App\Models\Terms\Attraction;
use App\Http\Requests\StoreAttractionRequest;
use App\Http\Requests\UpdateAttractionRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Session;
use App\DataTables\AttractionDataTable;

class AttractionController extends Controller
{

      private AttractionRepositoryInterface $attractionRepository;

    public function __construct(AttractionRepositoryInterface $attractionRepository)
    {
        $this->attractionRepository = $attractionRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AttractionDataTable $dataTable)
    {
        $data['attractions'] = Attraction::count();
        $data['title'] = 'Attraction List';

        return $dataTable->render('admin.terms.attractions.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $data['title'] = 'Add Attraction';
        //$data['attractions'] = $this->attractionRepository->getAttractionsByType();
        return view('admin.terms.attractions.create',$data);
    }

    public function getAttractionsAjax(Request $request): JsonResponse 
    {
        $type = $request->term_type;
        $id = isset($request->id)?$request->id:"";

        $data = [];
        if (isset($type) && !empty($type)) {
             $data = $this->attractionRepository->getAttractionsByType($type,$id);

        }
        return response()->json([
            'data' => $data
        ]);
    }
     public function changeStatus(Request $request): JsonResponse
    {
        $attractionId = $request->id;
          $attractionDetails = [
            'status' => $request->status,
        ];
        $this->attractionRepository->updateAttraction($attractionId, $attractionDetails);
  
        return response()->json(['success'=>'Status change successfully.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAttractionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttractionRequest $request)
    {
        $attractionDetails = [
            'name' => $request->name,
            'slug' => SlugService::createSlug(Attraction::class, 'slug', $request->name),
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'attraction_type' => $request->attraction_type,
            'description' => $request->description,
        ];
        $this->attractionRepository->createAttraction($attractionDetails);
        Session::flash('success','Attraction Created Successfully');
        return redirect()->Route('admin.terms.attractions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attraction  $attraction
     * @return \Illuminate\Http\Response
     */
    public function show(Attraction $attraction)
    {
         $data['attraction'] = $attraction;
        $data['title'] = 'Attraction';

        if (empty($data['attraction'])) {
            return back();
        }

        return view('admin.terms.attractions.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attraction  $attraction
     * @return \Illuminate\Http\Response
     */
    public function edit(Attraction $attraction)
    {
        $attractionId = $attraction->id;

        $data['attraction'] = $attraction;

        $data['title'] = 'Attraction Edit';

        if (empty($data['attraction'])) {
            return back();
        }
        $data['attractions'] = $this->attractionRepository->getAttractionsByType($data['attraction']->attraction_type,$attractionId);
        return view('admin.terms.attractions.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAttractionRequest  $request
     * @param  \App\Models\Attraction  $attraction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAttractionRequest $request, Attraction $attraction)
    {
       $attractionId = $attraction->id;
         
         $attractionDetails = [
            'name' => $request->name,
            'slug' => (!empty($request->slug) && $attraction->slug != $request->slug)?SlugService::createSlug(Attraction::class, 'slug', $request->slug):$attraction->slug,
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'attraction_type' => $request->attraction_type,
            'description' => $request->description,
            'status' => $request->status,
        ];

        $this->attractionRepository->updateAttraction($attractionId, $attractionDetails);
         Session::flash('success','Attraction Updated Successfully');
        return redirect()->Route('admin.terms.attractions.edit',$attractionId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attraction  $attraction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attraction $attraction)
    {
        $attractionId = $attraction->id;
        $this->attractionRepository->deleteAttraction($attractionId);
         Session::flash('success','Attraction Deleted Successfully');
        return back();
    }
    /**
     * Remove the specified all resource from storage.
     *
     * @param  \App\Models\Attraction  $attraction
     * @return \Illuminate\Http\Response
     */

     public function bulk_delete(Request $request)
    {
         if (!empty($request->ids)) {
        
        $attractionIds = get_array_mapping(json_decode($request->ids));
        $this->attractionRepository->deleteBulkAttraction($attractionIds);
         Session::flash('success','Attraction Bulk Deleted Successfully');
        }
        return back();
    }
}
