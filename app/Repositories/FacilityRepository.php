<?php

namespace App\Repositories;

use App\Interfaces\FacilityRepositoryInterface;
use App\Models\Terms\Facility;

class FacilityRepository implements FacilityRepositoryInterface 
{
    public function getAllFacilities() 
    {
        return Facility::orderBy('id','desc')->get();
    }
    public function getFacilitiesByType($type=null,$f_id = null) 
    {
        $facilityTypeBuilder = [];
        if (!empty($type)){
        $facilityTypeBuilder = Facility::where('status', Facility::ACTIVE)->where('facility_type',$type)->get(['id','name','parent_id']);
        }
        if (!empty($f_id)){
        $facilityTypeBuilder = Facility::where('status', Facility::ACTIVE)->where('id', '!=', $f_id)->where('parent_id', '!=', $f_id)->where('parent_id', 0)->get(['id','name','parent_id']);
        }

       return $facilityTypeBuilder;
    }

    public function getFacilityById($facilityId) 
    {
        return Facility::findOrFail($facilityId);
    }

    public function deleteFacility($facilityId) 
    {
        Facility::destroy($facilityId);
    }
    public function deleteBulkFacility($facilityIds) 
    {
         Facility::whereIn('id', $facilityIds)->delete();
    }

    public function createFacility(array $facilityDetails) 
    {
        return Facility::create($facilityDetails);
    }

    public function updateFacility($facilityId, array $newDetails) 
    {
        return Facility::whereId($facilityId)->update($newDetails);
    } 


    // Get all Active Facilities or by Type
    public function getActiveFacilitiesList($type = null) {
        $facilityBuilder = Facility::where('status', Facility::ACTIVE);

        if($type)
            $facilityBuilder->where('facility_type',$type);

        $facilities = $facilityBuilder->get(['id','name', 'parent_id']);

        $nestedResult = $facilities->toNested();

        return  $nestedResult;


    }

    // Get Active Hotel Type Facilities
    public function getActiveHotelFacilitiesList() {
        $type = Facility::HOTEL_TYPE;
        return $this->getActiveFacilitiesList($type);
    }
}
