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
        return Location::destroy($locationId);
    }

    public function deleteBulkLocation($locationIds) 
    {
         return Location::whereIn('id', $locationIds)->delete();
    }

    public function createLocation(array $locationDetails)
    {
        return Location::create($locationDetails);
    }
    public function updateLocation($locationId, array $newDetails)
    {
      $result = Location::whereId($locationId)->update($newDetails);
      return Location::findOrFail($result);
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