<?php

namespace App\Interfaces;

interface ActivityListsRepositoryInterface
{
    public function getAllActivityLists();
    public function getActivityListsById($activityListsId);
    public function forceDeleteActivityLists($activityListsId);
    public function forceBulkDeleteActivityLists($activityListsId);
    public function deleteActivityLists($activityListsId);
    public function deleteBulkActivityLists($activityListsId);
    public function createActivityLists(array $activityListsDetails);
    public function updateActivityLists($activityListsId, array $newDetails);
}