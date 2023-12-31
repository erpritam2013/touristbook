<?php

namespace App\Repositories;

use App\Interfaces\CountryRepositoryInterface;
use App\Models\Terms\Country;

class CountryRepository implements CountryRepositoryInterface 
{
    public function getAllCountries()
    {
        return Country::orderBy('id','desc')->get();
    }
    

    public function getCountryById($CountryId) 
    {
        return Country::findOrFail($CountryId);
    }

    public function deleteCountry($CountryId) 
    {
        Country::destroy($CountryId);
    }
    public function deleteBulkCountry($CountryIds) 
    {
        Country::whereIn('id', $CountryIds)->delete();
    }

    public function createCountry(array $CountryDetails) 
    {
        return Country::create($CountryDetails);
    }

    public function updateCountry($CountryId, array $newDetails) 
    {
        return Country::whereId($CountryId)->update($newDetails);
    } 

     // Get all Active Counties or by Type
    public function getCountiesList() {
        $CountryBuilder = Country::get(['id','countrycode','countryname','code']);
        
        return $CountryBuilder;
    }

}
