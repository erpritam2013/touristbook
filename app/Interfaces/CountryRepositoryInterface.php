<?php

namespace App\Interfaces;

interface CountryRepositoryInterface 
{
    public function getAllCountries();
    public function getCountryById($CountryId);
    public function deleteCountry($CountryId);
    public function deleteBulkCountry($CountryIds);
    public function createCountry(array $CountryDetails);
    public function updateCountry($CountryId, array $newDetails);
    public function getCountiesList();
    
}