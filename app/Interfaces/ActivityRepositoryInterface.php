<?php

namespace App\Interfaces;

interface ActivityRepositoryInterface
{
    public function getAllActivities();
    public function getActivityById($activityId);
    public function forceDeleteActivity($activityId);
    public function forceBulkDeleteActivity($activityId);
    public function deleteActivity($activityId);
    public function deleteBulkActivity($activityId);
    public function createActivity(array $activityDetails);
    public function updateActivity($activityId, array $newDetails);
}