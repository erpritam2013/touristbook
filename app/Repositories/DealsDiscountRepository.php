<?php

namespace App\Repositories;

use App\Interfaces\DealsDiscountRepositoryInterface;
use App\Models\Terms\DealsDiscount;

class DealsDiscountRepository implements DealsDiscountRepositoryInterface 
{
    public function getAllDealsDiscounts() 
    {
        return DealsDiscount::all();
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
        $dealsDiscountBuilder = DealsDiscount::where('status', DealsDiscount::ACTIVE);

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
