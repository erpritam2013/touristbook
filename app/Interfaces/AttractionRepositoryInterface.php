<?php

namespace App\Interfaces;

interface AttractionRepositoryInterface 
{
    public function getAllAttractions();
    public function getAttractionById($attractionId);
    public function deleteAttraction($attractionId);
    public function deleteBulkAttraction($attractionIds);
    public function createAttraction(array $attractionDetails);
    public function updateAttraction($attractionId, array $newDetails);
    public function getAttractionsByType(string $type);

    public function getActiveAttractionsList($type);
    public function getActiveHotelAttractionsList();
    public function getActiveActivityAttractionsList();
    
}