<?php

namespace App\Repositories;

use App\Interfaces\TopServiceRepositoryInterface;
use App\Models\Terms\TopService;

class TopServiceRepository implements TopServiceRepositoryInterface 
{
    public function getAllTopServices() 
    {
        return TopService::all();
    }
    public function getTopServicesByType($type=null,$ts_id=null) 
    {
               $topServiceTypeBuilder = [];
        if (!empty($type)){
        $topServiceTypeBuilder = TopService::where('status', TopService::ACTIVE)->where('top_service_type',$type)->get(['id','name','parent_id']);
        }
        if (!empty($pt_id)){
        $topServiceTypeBuilder = TopService::where('status', TopService::ACTIVE)->where('id', '!=', $pt_id)->where('parent_id', '!=', $pt_id)->where('parent_id', 0)->get(['id','name','parent_id']);
        }

       return $topServiceTypeBuilder;
    }

    public function getTopServiceById($TopServiceId) 
    {
        return TopService::findOrFail($TopServiceId);
    }

    public function deleteTopService($TopServiceId) 
    {
        TopService::destroy($TopServiceId);
    }
    public function deleteBulkTopService($TopServiceIds) 
    {
        TopService::whereIn('id', $TopServiceIds)->delete();
    }

    public function createTopService(array $TopServiceDetails) 
    {
        return TopService::create($TopServiceDetails);
    }

    public function updateTopService($TopServiceId, array $newDetails) 
    {
        return TopService::whereId($TopServiceId)->update($newDetails);
    } 


    // Get all Active Top Services or by Type
    public function getActiveTopServicesList($type = null) {
        $topServiceBuilder = TopService::where('status', TopService::ACTIVE);

        if($type)
            $topServiceBuilder->where('top_service_type',$type);

         $top_services = $topServiceBuilder->get(['id','name', 'parent_id']);

        $nestedResult = $top_services->toNested();

        return  $nestedResult;
    }

    // Get Active Hotel Type Medicare Assistances
    public function getActiveHotelTopServicesList() {
        $type = TopService::HOTEL_TYPE;
        return $this->getActiveTopServicesList($type);
    }
}
