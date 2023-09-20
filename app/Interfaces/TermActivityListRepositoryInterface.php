<?php

namespace App\Interfaces;

interface TermActivityListRepositoryInterface
{
    public function getAllTermActivityLists();
    public function getTermActivityListById($termActivityListId);
    public function deleteTermActivityList($termActivityListId);
    public function deleteBulkTermActivityList($termActivityListIds);
    public function createTermActivityList(array $termActivityListDetails);
    public function updateTermActivityList($termActivityListId, array $newDetails);
    public function getTermActivityListsByType(string $type);

    public function getActiveTermActivityList($type);
    public function getActiveActivityTermActivityList();
}
