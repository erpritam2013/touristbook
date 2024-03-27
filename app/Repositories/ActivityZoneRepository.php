<?php

namespace App\Repositories;

use App\Interfaces\ActivityZoneRepositoryInterface;
use App\Models\ActivityZone;

class ActivityZoneRepository implements ActivityZoneRepositoryInterface
{
    public function getAllActivityZones()
    {
        return ActivityZone::orderBy('id','desc')->get();
    }
    public function getActivityZoneById($activityZoneId)
    {
        return ActivityZone::findOrFail($activityZoneId);
    }
    public function getActivityZoneByCountry($country)
    {
        return ActivityZone::where('country',$country)->get(['id','title']);
    }
      public function forceDeleteActivityZone($activityZoneId)
    {
         ActivityZone::onlyTrashed()->find($activityZoneId)->forceDelete();
    }
    public function forceBulkDeleteActivityZones($activityZoneId)
    {
         ActivityZone::onlyTrashed()->whereIn('id', $activityZoneId)->forceDelete();
    }
    public function deleteActivityZone($activityZoneId)
    {
        ActivityZone::destroy($activityZoneId);
    }

    public function deleteBulkActivityZone($activityZoneId)
    {
         ActivityZone::whereIn('id', $activityZoneId)->delete();
    }
    public function createActivityZone(array $activityZoneDetails)
    {
        return ActivityZone::create($activityZoneDetails);
    }
    public function updateActivityZone($activityZoneId, array $newDetails)
    {
        return ActivityZone::whereId($activityZoneId)->update($newDetails);
    }

}
