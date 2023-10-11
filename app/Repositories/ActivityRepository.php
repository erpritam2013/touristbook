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
    public function getActivityById($activityId)
    {
        return Activity::findOrFail($activityId);
    }
    public function deleteActivity($activityId)
    {
        Activity::destroy($activityId);
    }

    public function deleteBulkActivity($activityId)
    {
         Activity::whereIn('id', $activityId)->delete();
    }
    public function createActivity(array $activityDetails)
    {
        return Activity::create($activityDetails);
    }
    public function updateActivity($activityId, array $newDetails)
    {
        return Activity::whereId($activityId)->update($newDetails);
    }

}
