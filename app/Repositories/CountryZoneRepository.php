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
      public function forceDeleteCountryZone($countryZoneId)
    {
         CountryZone::onlyTrashed()->find($countryZoneId)->forceDelete();
    }
    public function forceBulkDeleteCountryZone($countryZoneId)
    {
         CountryZone::onlyTrashed()->whereIn('id', $countryZoneId)->forceDelete();
    }
    public function deleteCountryZone($countryZoneId)
    {
        CountryZone::destroy($countryZoneId);
    }

    public function deleteBulkCountryZone($countryZoneId)
    {
         CountryZone::whereIn('id', $countryZoneId)->delete();
    }

     public function getCountryZoneByCountry($country)
    {
        return CountryZone::where('country',$country)->get(['id','title']);
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
