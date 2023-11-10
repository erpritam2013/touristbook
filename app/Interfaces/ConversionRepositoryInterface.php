<?php

namespace App\Interfaces;

interface ConversionRepositoryInterface
{
    public function getAllConversions();
    public function getConversionById($currencyId);
    public function deleteConversion($currencyId);
    public function deleteBulkConversions($currencyIds);
    public function createConversion(array $conversionDetails);
    public function updateConversion($currencyId, array $newDetails);
}
