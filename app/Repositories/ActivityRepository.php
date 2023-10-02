<?php

namespace App\Repositories;

use App\Interfaces\ActivityRepositoryInterface;
use App\Models\Activity;

class ActivityRepository implements ActivityRepositoryInterface
{
    public function getAllActivities()
    {
        return Activity::orderBy('id','desc')->get();
    }
    public function getActivityById($ActivityId)
    {
        return Activity::findOrFail($ActivityId);
    }
    public function deleteActivity($ActivityId)
    {
        Activity::destroy($ActivityId);
    }

    public function deleteBulkActivity($ActivityId)
    {
         Activity::whereIn('id', $ActivityId)->delete();
    }
    public function createActivity(array $ActivityDetails)
    {
        return Activity::create($ActivityDetails);
    }
    public function updateActivity($ActivityId, array $newDetails)
    {
        return Activity::whereId($ActivityId)->update($newDetails);
    }

}
