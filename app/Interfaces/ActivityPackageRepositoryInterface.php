<?php

namespace App\Interfaces;

interface ActivityPackageRepositoryInterface
{
    public function getAllActivityPackage();
    public function getActivityPackageById($activityPackageId);
    public function deleteActivityPackage($activityPackageId);
    public function deleteBulkActivityPackage($activityPackageId);
    public function createActivityPackage(array $activityPackageDetails);
    public function updateActivityPackage($activityPackageId, array $newDetails);
}