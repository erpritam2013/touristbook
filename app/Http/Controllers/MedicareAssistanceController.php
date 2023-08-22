<?php

namespace App\Http\Controllers;
use App\Interfaces\MedicareAssistanceRepositoryInterface;
use App\Models\Terms\MedicareAssistance;
use App\Http\Requests\StoreMedicareAssistanceRequest;
use App\Http\Requests\UpdateMedicareAssistanceRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Session;

class MedicareAssistanceController extends Controller
{


    private MedicareAssistanceRepositoryInterface $MedicareAssistanceRepository;

    public function __construct(MedicareAssistanceRepositoryInterface $MedicareAssistanceRepository)
    {
        $this->MedicareAssistanceRepository = $MedicareAssistanceRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['medicare_assistances'] = $this->MedicareAssistanceRepository->getAllMedicareAssistances();
        $data['title'] = 'Medicare Assistance List';

        return view('admin.terms.medicare-assistances.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Medicare Assistance';
        return view('admin.terms.medicare-assistances.create',$data);
    }

       public function getMedicareAssistancesAjax(Request $request): JsonResponse 
    {
        
        $type = $request->term_type;
        $id = isset($request->id)?$request->id:"";

        $data = [];
        if (isset($type) && !empty($type)) {
             $data = $this->MedicareAssistanceRepository->getMedicareAssistancesByType($type,$id);

        }
        return response()->json([
            'data' => $data
        ]);
    }
     public function changeStatus(Request $request): JsonResponse
    {
        $MedicareAssistanceId = $request->id;
          $MedicareAssistanceDetails = [
            'status' => $request->status,
        ];
        $this->MedicareAssistanceRepository->updateMedicareAssistance($MedicareAssistanceId, $MedicareAssistanceDetails);
  
        return response()->json(['success'=>'Status change successfully.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMedicareAssistanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMedicareAssistanceRequest $request)
    {
        $MedicareAssistanceDetails = [
            'name' => $request->name,
            'slug' => SlugService::createSlug(MedicareAssistance::class, 'slug', $request->name),
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'medicare_assistance_type' => $request->medicare_assistance_type,
            'description' => $request->description,
        ];
        $this->MedicareAssistanceRepository->createMedicareAssistance($MedicareAssistanceDetails);
        Session::flash('success','Medicare Assistance Created Successfully');
        return redirect()->Route('admin.terms.medicare-assistances.index');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MedicareAssistance  $medicareAssistance
     * @return \Illuminate\Http\Response
     */
    public function show(MedicareAssistance $medicareAssistance)
    {
         $data['medicareAssistance'] = $medicareAssistance;
        $data['title'] = 'Medicare Assistance';

        if (empty($data['medicareAssistance'])) {
            return back();
        }

        return view('admin.terms.medicare-assistances.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MedicareAssistance  $medicareAssistance
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicareAssistance $medicareAssistance)
    {
         $MedicareAssistanceId = $medicareAssistance->id;

        $data['medicareAssistance'] = $medicareAssistance;
        
        $data['title'] = 'Medicare Assistance Edit';

        if (empty($data['medicareAssistance'])) {
            return back();
        }
        $data['medicare_assistances'] = $this->MedicareAssistanceRepository->getMedicareAssistancesByType($data['medicareAssistance']->medicare_assistance_type,$MedicareAssistanceId);
        return view('admin.terms.medicare-assistances.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMedicareAssistanceRequest  $request
     * @param  \App\Models\MedicareAssistance  $medicareAssistance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMedicareAssistanceRequest $request, MedicareAssistance $medicareAssistance)
    {
        $MedicareAssistanceId = $medicareAssistance->id;
         
         $MedicareAssistanceDetails = [
            'name' => $request->name,
            //'slug' => SlugService::createSlug(Post::class, 'slug', $request->name),
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'medicare_assistance_type' => $request->medicare_assistance_type,
            'description' => $request->description,
            'status' => $request->status,
        ];

        $this->MedicareAssistanceRepository->updateMedicareAssistance($MedicareAssistanceId, $MedicareAssistanceDetails);
         Session::flash('success','Medicare Assistance Updated Successfully');
        return redirect()->Route('admin.terms.medicare-assistances.edit',$MedicareAssistanceId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MedicareAssistance  $medicareAssistance
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicareAssistance $medicareAssistance)
    {
        $MedicareAssistanceId = $medicareAssistance->id;
        $this->MedicareAssistanceRepository->deleteMedicareAssistance($MedicareAssistanceId);
         Session::flash('success','Medicare Assistance Deleted Successfully');
        return back();
    }

    /**
     * Remove the specified all resource from storage.
     *
     * @param  \App\Models\MedicareAssistance  $medicareAssistance
     * @return \Illuminate\Http\Response
     */
    public function bulk_delete(Request $request)
    {
        
        if (!empty($request->ids)) {

        $MedicareAssistanceIds = get_array_mapping(json_decode($request->ids));
        $this->MedicareAssistanceRepository->deleteBulkMedicareAssistance($MedicareAssistanceIds);
         Session::flash('success','Medicare Assistance Bulk Deleted Successfully');
        }
        return back();
    }
}
