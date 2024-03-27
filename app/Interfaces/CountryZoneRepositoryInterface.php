<?php

namespace App\Interfaces;

interface CountryZoneRepositoryInterface
{
    public function getAllCountryZones();
    public function getCountryZoneById($countryZoneId);
    public function forceDeleteCountryZone($countryZoneId);
    public function forceBulkDeleteCountryZone($countryZoneId);
    public function deleteCountryZone($countryZoneId);
    public function deleteBulkCountryZone($countryZoneId);
    public function createCountryZone(array $countryZoneDetails);
    public function updateCountryZone($countryZoneId, array $newDetails);
    public function getCountryZoneByCountry($country);
}