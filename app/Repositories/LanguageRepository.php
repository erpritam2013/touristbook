<?php

namespace App\Repositories;

use App\Interfaces\LanguageRepositoryInterface;
use App\Models\Terms\Language;

class LanguageRepository implements LanguageRepositoryInterface 
{
    public function getAllLanguages()
    {
        return Language::orderBy('id','desc')->get();
    }
    public function getLanguagesByType($type=null,$l_id=null) 
    {
        //return Language::where('language_type',$type)->where('id', '!=', $a_id)->get(['id','name']);
        return Language::where('id', '!=', $l_id)->get(['id','name','parent_id']);
    }

    public function getLanguageById($languageId) 
    {
        return Language::findOrFail($languageId);
    }

    public function deleteLanguage($languageId) 
    {
        Language::destroy($languageId);
    }
    public function deleteBulkLanguage($languageIds) 
    {
        Language::whereIn('id', $languageIds)->delete();
    }

    public function createLanguage(array $languageDetails) 
    {
        return Language::create($languageDetails);
    }

    public function updateLanguage($languageId, array $newDetails) 
    {
        return Language::whereId($languageId)->update($newDetails);
    } 



    // Get all Active Languages or by Type
    public function getActiveLanguagesList($type = null) {
        $languageBuilder = Language::where('status', Language::ACTIVE);

        // if($type)
        //     $languageBuilder->where('language_type',$type);

        return $languageBuilder->get(['id','name','parent_id']);
    }

    // Get Active Hotel Type Languages
    // public function getActiveHotelLanguagesList() {
    //     $type = Language::HOTEL_TYPE;
    //     return $this->getActiveLanguagesList($type);
    // }
}
