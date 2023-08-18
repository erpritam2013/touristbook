<?php

namespace App\Repositories;

use App\Interfaces\AmenityRepositoryInterface;
use App\Models\Terms\Amenity;

class AmenityRepository implements AmenityRepositoryInterface 
{
    public function getAllAmenities()
    {
        return Amenity::all();
    }
    public function getAmenitiesByType($type=null,$a_id=null) 
    {
        return Amenity::where('amenity_type',$type)->where('id', '!=', $a_id)->get(['id','name']);
    }

    public function getAmenityById($amenityId) 
    {
        return Amenity::findOrFail($amenityId);
    }

    public function deleteAmenity($amenityId) 
    {
        Amenity::destroy($amenityId);
    }
    public function deleteBulkAmenity($amenityIds) 
    {
        Amenity::whereIn('id', $amenityIds)->delete();
    }

    public function createAmenity(array $amenityDetails) 
    {
        return Amenity::create($amenityDetails);
    }

    public function updateAmenity($amenityId, array $newDetails) 
    {
        return Amenity::whereId($amenityId)->update($newDetails);
    } 



    // Get all Active Amenities or by Type
    public function getActiveAmenitiesList($type = null) {
        $amenityBuilder = Amenity::where('status', Amenity::ACTIVE);

        if($type)
            $amenityBuilder->where('amenity_type',$type);

        return $amenityBuilder->get(['id','name']);
    }

    // Get Active Hotel Type Amenities
    public function getActiveHotelAmenitiesList() {
        $type = Amenity::HOTEL_TYPE;
        return $this->getActiveAmenitiesList($type);
    }
}
