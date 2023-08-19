<?php

namespace App\Interfaces;

interface StateRepositoryInterface 
{
    public function getAllStates();
    public function getStateById($StateId);
    public function deleteState($StateId);
    public function deleteBulkState($StateIds);
    public function createState(array $StateDetails);
    public function updateState($StateId, array $newDetails);

    public function getActiveStatesList($StateId);
    
}