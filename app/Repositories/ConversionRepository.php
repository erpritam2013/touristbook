<?php

namespace App\Repositories;

use App\Interfaces\ConversionRepositoryInterface;
use App\Models\Conversion;
use Illuminate\Support\Facades\Hash;

class ConversionRepository implements ConversionRepositoryInterface
{

    public function getAllConversions()
    {
        return Conversion::orderBy('id','desc')->get();
    }

    public function getConversionById($currencyId)
    {
        $conversion = Conversion::where('status', Conversion::ACTIVE)
                                    ->where('id', $currencyId)->first();
        return $conversion;

    }

    public function deleteConversion($currencyId)
    {
        Conversion::destroy($currencyId);
    }

    public function deleteBulkConversions($currencyIds)
    {
        Conversion::whereIn('id', $currencyIds)->delete();
    }

    public function createConversion(array $conversionDetails)
    {
        return Conversion::create($conversionDetails);
    }

    public function updateConversion($currencyId, array $newDetails)
    {
        return Conversion::whereId($currencyId)->update($newDetails);
    }
}
