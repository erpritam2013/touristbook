<?php

namespace App\Repositories;

use App\Interfaces\OccupancyRepositoryInterface;
use App\Models\Terms\Occupancy;

class OccupancyRepository implements OccupancyRepositoryInterface 
{
    public function getAllOccupancies() 
    {
        return Occupancy::orderBy('id','desc')->get();
    }
    public function getOccupanciesByType($type=null,$o_id=null) 
    {
        $occupancyTypeBuilder = [];
        if (!empty($type)){
        $occupancyTypeBuilder = Occupancy::where('status', Occupancy::ACTIVE)->where('occupancy_type',$type)->get(['id','name','parent_id']);
        }
        if (!empty($o_id)){
        $occupancyTypeBuilder = Occupancy::where('status', Occupancy::ACTIVE)->where('id', '!=', $o_id)->where('parent_id', '!=', $o_id)->where('parent_id', 0)->get(['id','name','parent_id']);
        }

       return $occupancyTypeBuilder;
    }

    public function getOccupancyById($OccupancyId) 
    {
        return Occupancy::findOrFail($OccupancyId);
    }

    public function deleteOccupancy($OccupancyId) 
    {
        Occupancy::destroy($OccupancyId);
    }
    public function deleteBulkOccupancy($OccupancyIds) 
    {
         Occupancy::whereIn('id', $OccupancyIds)->delete();
    }

    public function createOccupancy(array $OccupancyDetails) 
    {
        return Occupancy::create($OccupancyDetails);
    }

    public function updateOccupancy($OccupancyId, array $newDetails) 
    {
        return Occupancy::whereId($OccupancyId)->update($newDetails);
    } 

    // Get all Active Occupancies or by Type
    public function getActiveOccupanciesList($type = null) {
        $occupancyBuilder = Occupancy::orderBy('name','asc')->where('status', Occupancy::ACTIVE);

        if($type)
            $occupancyBuilder->where('occupancy_type',$type);

         $occupances = $occupancyBuilder->get(['id','name', 'parent_id']);

        $nestedResult = $occupances->toNested();

        return  $nestedResult;
    }

    // Get Active Hotel Type Occupancies
    public function getActiveHotelOccupanciesList() {
        $type = Occupancy::HOTEL_TYPE;
        return $this->getActiveOccupanciesList($type);
    }
}
