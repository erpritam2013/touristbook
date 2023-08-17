<?php

namespace App\Interfaces;

interface TopServiceRepositoryInterface 
{
    public function getAllTopServices();
    public function getTopServiceById($TopServiceId);
    public function deleteTopService($TopServiceId);
    public function deleteBulkTopService($TopServiceIds);
    public function createTopService(array $TopServiceDetails);
    public function updateTopService($TopServiceId, array $newDetails);
    public function getTopServicesByType(string $type);
}
