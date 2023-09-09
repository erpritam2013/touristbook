<?php

namespace App\Repositories;

use App\Interfaces\LocationRepositoryInterface;
use App\Models\Location;
use App\Models\LocationMeta;

class LocationRepository implements LocationRepositoryInterface
{
    public function getAllLocations()
    {
        return Location::orderBy('id','desc')->get();
    }
    public function getLocationById($locationId)
    {
        return Location::findOrFail($locationId);
    }
    public function deleteLocation($locationId)
    {
        Location::destroy($locationId);
    }

    public function deleteBulkLocation($locationIds) 
    {
         Location::whereIn('id', $locationIds)->delete();
    }

    public function createLocation(array $locationDetails)
    {
        return Location::create($locationDetails);
    }
    public function updateLocation($locationId, array $newDetails)
    {
        return Location::whereId($locationId)->update($newDetails);
    }
    public function createLocationMeta(array $locationMetaDetails)
    {
        return LocationMeta::create($locationMetaDetails);
    }
    public function updateLocationMeta($locationId, array $newLocationMetaDetails)
    {
        return LocationMeta::where('location_id',$locationId)->update($newLocationMetaDetails);
    }
    
}