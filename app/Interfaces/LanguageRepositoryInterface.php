<?php

namespace App\Interfaces;

interface LanguageRepositoryInterface 
{
    public function getAllLanguages();
    public function getLanguageById($languageId);
    public function deleteLanguage($languageId);
    public function deleteBulkLanguage($languageIds);
    public function createLanguage(array $languageDetails);
    public function updateLanguage($languageId, array $newDetails);
    public function getLanguagesByType(string $type);

    public function getActiveLanguagesList($type);
    // public function getActiveHotelLanguagesList();
    
}