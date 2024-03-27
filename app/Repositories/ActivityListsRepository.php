<?php

namespace App\Repositories;

use App\Interfaces\ActivityListsRepositoryInterface;
use App\Models\ActivityLists;

class ActivityListsRepository implements ActivityListsRepositoryInterface
{
    public function getAllActivityLists()
    {
        return ActivityLists::orderBy('id','desc')->get();
    }
    public function getActivityListsById($activityListsId)
    {
        return ActivityLists::findOrFail($activityListsId);
    }
      public function forceDeleteActivityLists($activityListsId)
    {
         ActivityLists::onlyTrashed()->find($activityListsId)->forceDelete();
    }
    public function forceBulkDeleteActivityLists($activityListsId)
    {
         ActivityLists::onlyTrashed()->whereIn('id', $activityListsId)->forceDelete();
    }
    public function deleteActivityLists($activityListsId)
    {
        ActivityLists::destroy($activityListsId);
    }

    public function deleteBulkActivityLists($activityListsId)
    {
         ActivityLists::whereIn('id', $activityListsId)->delete();
    }
    public function createActivityLists(array $activityListsDetails)
    {
        return ActivityLists::create($activityListsDetails);
    }
    public function updateActivityLists($activityListsId, array $newDetails)
    {
        return ActivityLists::whereId($activityListsId)->update($newDetails);
    }

}
