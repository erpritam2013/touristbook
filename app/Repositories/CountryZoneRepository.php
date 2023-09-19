<?php

namespace App\Repositories;

use App\Interfaces\CountryZoneRepositoryInterface;
use App\Models\CountryZone;

class CountryZoneRepository implements CountryZoneRepositoryInterface
{
    public function getAllCountryZones()
    {
        return CountryZone::orderBy('id','desc')->get();
    }
    public function getCountryZoneById($countryZoneId)
    {
        return CountryZone::findOrFail($countryZoneId);
    }
    public function deleteCountryZone($countryZoneId)
    {
        CountryZone::destroy($countryZoneId);
    }

    public function deleteBulkCountryZone($countryZoneId)
    {
         CountryZone::whereIn('id', $countryZoneId)->delete();
    }
    public function createCountryZone(array $countryZoneDetails)
    {
        return CountryZone::create($countryZoneDetails);
    }
    public function updateCountryZone($countryZoneId, array $newDetails)
    {
        return CountryZone::whereId($countryZoneId)->update($newDetails);
    }

}
