<?php

namespace App\Http\Controllers;
use App\Interfaces\TermActivityListRepositoryInterface;
use App\Models\Terms\TermActivityList;
use App\Http\Requests\StoreTermActivityListRequest;
use App\Http\Requests\UpdateTermActivityListRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Session;
use App\DataTables\TermActivityListDataTable;

class TermActivityListController extends Controller
{

     private TermActivityListRepositoryInterface $termActivityListRepository;

    public function __construct(TermActivityListRepositoryInterface $termActivityListRepository)
    {
        $this->termActivityListRepository = $termActivityListRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TermActivityListDataTable $dataTable)
    {
         $data['term_activity_lists'] = TermActivityList::count();
        $data['title'] = 'Term Activity List';

        return $dataTable->render('admin.terms.term-activity-lists.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Term Activity List';
        //$data['term_activity_lists'] = $this->termActivityListRepository->getTermActivityListsByType();
        return view('admin.terms.term-activity-lists.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTermActivityListRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTermActivityListRequest $request)
    {
         $termActivityListDetails = [
            'name' => $request->name,
            'slug' => SlugService::createSlug(TermActivityList::class, 'slug', $request->name),
            'parent' => (!empty($request->parent))?$request->parent:null,
            'icon' => (!empty($request->icon))?$request->icon:"",
            // 'term_activity_list_type' => $request->term_activity_list_type,
            'description' => $request->description,
        ];
        $this->termActivityListRepository->createTermActivityList($termActivityListDetails);
        Session::flash('success','Term Activity List Created Successfully');
        return redirect()->Route('admin.terms.term-activity-lists.index');
    }

        public function getTermActivityListAjax(Request $request): JsonResponse 
    {
        $type = $request->term_type;
        $id = isset($request->id)?$request->id:"";

        $data = [];
        if (isset($type) && !empty($type)) {
             $data = $this->termActivityListRepository->getTermActivityListsByType($type,$id);

        }
        return response()->json([
            'data' => $data
        ]);
    }
     public function changeStatus(Request $request): JsonResponse
    {
        $termActivityListId = $request->id;
          $termActivityListDetails = [
            'status' => $request->status,
        ];
        $this->termActivityListRepository->updateTermActivityList($termActivityListId, $termActivityListDetails);
  
        return response()->json(['success'=>'Status change successfully.']);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TermActivityList  $termActivityList
     * @return \Illuminate\Http\Response
     */
    public function show(TermActivityList $termActivityList)
    {
         $data['term_activity_list'] = $termActivityList;
        $data['title'] = 'Term Activity List';

        if (empty($data['term_activity_list'])) {
            return back();
        }

        return view('admin.terms.term-activity-lists.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TermActivityList  $termActivityList
     * @return \Illuminate\Http\Response
     */
    public function edit(TermActivityList $termActivityList)
    {
         $termActivityListId = $termActivityList->id;

        $data['term_activity_list'] = $termActivityList;

        $data['title'] = 'Term Activity List Edit';

        if (empty($data['term_activity_list'])) {
            return back();
        }
        // $data['term_activity_lists'] = $this->termActivityListRepository->getTermActivityListsByType($data['term_activity_list']->term_activity_list_type,$termActivityListId);
        $data['term_activity_lists'] = $this->termActivityListRepository->getTermActivityListsByType(null,$termActivityListId);
        return view('admin.terms.term-activity-lists.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTermActivityListRequest  $request
     * @param  \App\Models\TermActivityList  $termActivityList
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTermActivityListRequest $request, TermActivityList $termActivityList)
    {
       $termActivityListId = $termActivityList->id;
         
         $termActivityListDetails = [
            'name' => $request->name,
             'slug' => (!empty($request->slug) && $termActivityList->slug != $request->slug)?SlugService::createSlug(TermActivityList::class, 'slug', $request->slug):$termActivityList->slug,
            'parent' => (!empty($request->parent))?$request->parent:null,
            'icon' => (!empty($request->icon))?$request->icon:"",
            //'term_activity_list_type' => $request->term_activity_list_type,
            'description' => $request->description,
            'status' => $request->status,
        ];

        $this->termActivityListRepository->updateTermActivityList($termActivityListId, $termActivityListDetails);
         Session::flash('success','Term Activity List Updated Successfully');
        return redirect()->Route('admin.terms.term-activity-lists.edit',$termActivityListId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TermActivityList  $termActivityList
     * @return \Illuminate\Http\Response
     */
      public function destroy(TermActivityList $termActivityList)
    {
        $termActivityListId = $termActivityList->id;
        $this->termActivityListRepository->deleteTermActivityList($termActivityListId);
         Session::flash('success','Term Activity List Deleted Successfully');
        return back();
    }

      /**
     * Remove the specified all resource from storage.
     *
     * @param  \App\Models\TermActivityList  $termActivityList
     * @return \Illuminate\Http\Response
     */

     public function bulk_delete(Request $request)
    {
         if (!empty($request->ids)) {
        
        $termActivityListIds = get_array_mapping(json_decode($request->ids));
        $this->termActivityListRepository->deleteBulkTermActivityList($termActivityListIds);
         Session::flash('success','Term Activity List Bulk Deleted Successfully');
        }
        return back();
    }
}
