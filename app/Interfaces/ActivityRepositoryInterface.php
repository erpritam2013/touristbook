<?php

namespace App\Interfaces;

interface ActivityRepositoryInterface
{
    public function getAllActivities();
    public function getActivityById($ActivityId);
    public function deleteActivity($ActivityId);
    public function deleteBulkActivity($ActivityId);
    public function createActivity(array $ActivityDetails);
    public function updateActivity($ActivityId, array $newDetails);
}