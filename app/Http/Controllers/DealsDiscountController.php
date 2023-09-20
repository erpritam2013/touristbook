<?php

namespace App\Http\Controllers;

use App\Interfaces\DealsDiscountRepositoryInterface;
use App\Models\Terms\DealsDiscount;
use App\Http\Requests\StoreDealsDiscountRequest;
use App\Http\Requests\UpdateDealsDiscountRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Session;
use App\DataTables\DealsDiscountDataTable;
class DealsDiscountController extends Controller
{

     private DealsDiscountRepositoryInterface $dealsDiscountRepository;

    public function __construct(DealsDiscountRepositoryInterface $dealsDiscountRepository)
    {
        $this->dealsDiscountRepository = $dealsDiscountRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DealsDiscountDataTable $dataTable)
    {
        // $data['deal_discounts'] = $this->dealsDiscountRepository->getAllDealsDiscounts();
        $data['deal_discounts'] = DealsDiscount::count();
        $data['title'] = 'Deals & Discount List';

       return $dataTable->render('admin.terms.deal-discounts.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Add Deals & Discount';
        //$data['deal_discounts'] = $this->dealsDiscountRepository->getDealsDiscountsByType();
        return view('admin.terms.deal-discounts.create',$data);
    }

    public function getDealsDiscountAjax(Request $request): JsonResponse 
    {
        $type = $request->term_type;
        $id = isset($request->id)?$request->id:"";

        $data = [];
        if (isset($type) && !empty($type)) {
             $data = $this->dealsDiscountRepository->getDealsDiscountsByType($type,$id);

        }
        return response()->json([
            'data' => $data
        ]);
    }

     public function changeStatus(Request $request): JsonResponse
    {
        $dealsDiscountId = $request->id;
          $dealsDiscountDetails = [
            'status' => $request->status,
        ];
        $this->dealsDiscountRepository->updateDealsDiscount($dealsDiscountId, $dealsDiscountDetails);
  
        return response()->json(['success'=>'Status change successfully.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDealsDiscountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDealsDiscountRequest $request)
    {
        $dealsDiscountDetails = [
            'name' => $request->name,
            'slug' => SlugService::createSlug(DealsDiscount::class, 'slug', $request->name),
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'deals_discount_type' => $request->deals_discount_type,
            'description' => $request->description,
        ];
        $this->dealsDiscountRepository->createDealsDiscount($dealsDiscountDetails);
        Session::flash('success','Deals & Discount Created Successfully');
        return redirect()->Route('admin.terms.deal-discounts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DealsDiscount  $dealsDiscount
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $dealsDiscount = DealsDiscount::findOrFail($id);
        $data['deal_discount'] = $dealsDiscount;
        $data['title'] = 'Deals & Discount';

        if (empty($data['deal_discount'])) {
            return back();
        }
        // $dealsDiscountId = $dealsDiscount->id;

        return view('admin.terms.deal-discounts.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DealsDiscount  $dealsDiscount
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         
        $dealsDiscount = DealsDiscount::findOrFail($id);

        $data['deal_discount'] = $dealsDiscount;

        $data['title'] = 'Deals & Discount Edit';

        if (empty($data['deal_discount'])) {
            return back();
        }
         $dealsDiscountId = $dealsDiscount->id;
        $data['deal_discounts'] = $this->dealsDiscountRepository->getDealsDiscountsByType($data['deal_discount']->deals_discount_type,$dealsDiscountId);
        return view('admin.terms.deal-discounts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDealsDiscountRequest  $request
     * @param  \App\Models\DealsDiscount  $dealsDiscount
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDealsDiscountRequest $request, DealsDiscount $dealsDiscount)
    {
       $dealsDiscountId = $dealsDiscount->id;
         
         $dealsDiscountDetails = [
            'name' => $request->name,
           'slug' => (!empty($request->slug) && $dealsDiscount->slug != $request->slug)?SlugService::createSlug(DealsDiscount::class, 'slug', $request->slug):$dealsDiscount->slug,
            'parent_id' => (!empty($request->parent_id))?$request->parent_id:0,
            'icon' => (!empty($request->icon))?$request->icon:"",
            'deals_discount_type' => $request->deals_discount_type,
            'description' => $request->description,
            'status' => $request->status,
        ];

        $this->dealsDiscountRepository->updateDealsDiscount($dealsDiscountId, $dealsDiscountDetails);
         Session::flash('success','Deals & Discount Updated Successfully');
        return redirect()->Route('admin.terms.deal-discounts.edit',$dealsDiscountId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DealsDiscount  $dealsDiscount
     * @return \Illuminate\Http\Response
     */
    public function destroy(DealsDiscount $dealsDiscount)
    {
        $dealsDiscountId = $dealsDiscount->id;
        $this->dealsDiscountRepository->deleteDealsDiscount($dealsDiscountId);
         Session::flash('success','Deals & Discount Deleted Successfully');
        return back();
    }

       /**
     * Remove the specified all resource from storage.
     *
     * @param  \App\Models\DealsDiscount  $DealsDiscount
     * @return \Illuminate\Http\Response
     */
    public function bulk_delete(Request $request)
    {
         if (!empty($request->ids)) {
        
        $dealsDiscountIds = get_array_mapping(json_decode($request->ids));
        $this->dealsDiscountRepository->deleteBulkDealsDiscount($dealsDiscountIds);
         Session::flash('success','Deals & Discount Bulk Deleted Successfully');
        }
        return back();
    }
}
