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
        return ActivityZone::findOrFail($ActivityZoneId);
    }
    public function getActivityZoneByCountry($country)
    {
        return ActivityZone::where('country',$country)->get(['id','title']);
    }
    public function deleteActivityZone($ActivityZoneId)
    {
        ActivityZone::destroy($ActivityZoneId);
    }

    public function deleteBulkActivityZone($ActivityZoneId)
    {
         ActivityZone::whereIn('id', $ActivityZoneId)->delete();
    }
    public function createActivityZone(array $ActivityZoneDetails)
    {
        return ActivityZone::create($ActivityZoneDetails);
    }
    public function updateActivityZone($ActivityZoneId, array $newDetails)
    {
        return ActivityZone::whereId($ActivityZoneId)->update($newDetails);
    }

}
