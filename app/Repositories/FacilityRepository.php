<?php

namespace App\Repositories;

use App\Interfaces\FacilityRepositoryInterface;
use App\Models\Terms\Facility;

class FacilityRepository implements FacilityRepositoryInterface 
{
    public function getAllFacilities() 
    {
        return Facility::all();
    }
    public function getFacilitiesByType($type=null,$f_id=null) 
    {
        return Facility::where('facility_type',$type)->where('id', '!=', $f_id)->get(['id','name']);
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

        return $facilityBuilder->get(['id','name']);
    }

    // Get Active Hotel Type Facilities
    public function getActiveHotelFacilitiesList() {
        $type = Facility::HOTEL_TYPE;
        return $this->getActiveFacilitiesList($type);
    }
}
