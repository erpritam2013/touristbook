<?php

namespace App\Repositories;

use App\Interfaces\DealsDiscountRepositoryInterface;
use App\Models\Terms\DealsDiscount;
use App\Models\Setting;
use App\Models\Page;
class DealsDiscountRepository implements DealsDiscountRepositoryInterface 
{

    private $commanDealsDiscount = null;
    public function __construct()
    {
        $page_id = Setting::get_setting('hotel_list_page');
        if (!empty($page_id)) {   
        $page = Page::find($page_id);
          if (isset($page->extra_data['hotel_common_deals_discount'])) {
              $this->commanDealsDiscount = $page->extra_data['hotel_common_deals_discount'];
          }
        }

    }
    public function getAllDealsDiscounts() 
    {
        return DealsDiscount::orderBy('id','desc')->get();
    }
    public function getDealsDiscountsByType($type=null,$dd_id=null) 
    {
               $DealsDiscount = [];
        if (!empty($type)){
        $DealsDiscount = DealsDiscount::where('status', DealsDiscount::ACTIVE)->where('deals_discount_type',$type)->get(['id','name','parent_id']);
        }
        if (!empty($dd_id)){
        $DealsDiscount = DealsDiscount::where('status', DealsDiscount::ACTIVE)->where('id', '!=', $dd_id)->where('parent_id', '!=', $dd_id)->where('parent_id', 0)->get(['id','name','parent_id']);
        }

       return $DealsDiscount;
    }

    public function getDealsDiscountById($dealsDiscountId) 
    {
        return DealsDiscount::findOrFail($dealsDiscountId);
    }

    public function deleteDealsDiscount($dealsDiscountId) 
    {
        DealsDiscount::destroy($dealsDiscountId);
    }
    public function deleteBulkDealsDiscount($dealsDiscountIds) 
    {
        DealsDiscount::whereIn('id', $dealsDiscountIds)->delete();
    }

    public function createDealsDiscount(array $dealsDiscountDetails) 
    {
        return DealsDiscount::create($dealsDiscountDetails);
    }

    public function updateDealsDiscount($dealsDiscountId, array $newDetails) 
    {
        return DealsDiscount::whereId($dealsDiscountId)->update($newDetails);
    } 


    // Get all Active Top Services or by Type
    public function getActiveDealsDiscountsList($type = null) {

       

        $dealsDiscountBuilder = DealsDiscount::orderBy('name','asc')->where('status', DealsDiscount::ACTIVE);

        if($type)
            $dealsDiscountBuilder->where('deals_discount_type',$type);

         $dealsDiscounts = $dealsDiscountBuilder->get(['id','name', 'parent_id']);

        $nestedResult = $dealsDiscounts->toNested();

        return  $nestedResult;
    }
    public function getActiveHotelDealsDiscountsListFilter($type = null) {

        if(!empty($this->commanDealsDiscount)){

        $dealsDiscountBuilder = DealsDiscount::orderBy('name','asc')->where('status', DealsDiscount::ACTIVE)->whereIn('id',$this->commanDealsDiscount);
    }else{

        $dealsDiscountBuilder = DealsDiscount::orderBy('name','asc')->where('status', DealsDiscount::ACTIVE);
    }

        if($type)
            $dealsDiscountBuilder->where('deals_discount_type',$type);

         $dealsDiscounts = $dealsDiscountBuilder->get(['id','name', 'parent_id']);

        $nestedResult = $dealsDiscounts->toNested();

        return  $nestedResult;
    }

    // Get Active Hotel Type Medicare Assistances
    public function getActiveHotelDealsDiscountsList() {
        $type = DealsDiscount::HOTEL_TYPE;
        return $this->getActiveDealsDiscountsList($type);
    }
}
