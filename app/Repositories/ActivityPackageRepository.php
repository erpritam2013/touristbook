<?php

namespace App\Repositories;

use App\Interfaces\ActivityPackageRepositoryInterface;
use App\Models\ActivityPackage;

class ActivityPackageRepository implements ActivityPackageRepositoryInterface
{
    public function getAllActivityPackage()
    {
        return ActivityPackage::orderBy('id','desc')->get();
    }
    public function getActivityPackageById($activityPackageId)
    {
        return ActivityPackage::findOrFail($activityPackageId);
    }
      public function forceDeleteActivityPackage($activityPackageId)
    {
         ActivityPackage::onlyTrashed()->find($activityPackageId)->forceDelete();
    }
    public function forceBulkDeleteActivityPackages($activityPackageId)
    {
         ActivityPackage::onlyTrashed()->whereIn('id', $activityPackageId)->forceDelete();
    }
    public function deleteActivityPackage($activityPackageId)
    {
        ActivityPackage::destroy($activityPackageId);
    }

    public function deleteBulkActivityPackage($activityPackageId)
    {
         ActivityPackage::whereIn('id', $activityPackageId)->delete();
    }
    public function createActivityPackage(array $activityPackageDetails)
    {
        return ActivityPackage::create($activityPackageDetails);
    }
    public function updateActivityPackage($activityPackageId, array $newDetails)
    {
        return ActivityPackage::whereId($activityPackageId)->update($newDetails);
    }

}
