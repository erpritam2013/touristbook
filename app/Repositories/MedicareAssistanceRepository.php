<?php

namespace App\Repositories;

use App\Interfaces\MedicareAssistanceRepositoryInterface;
use App\Models\Terms\MedicareAssistance;

class MedicareAssistanceRepository implements MedicareAssistanceRepositoryInterface 
{
    public function getAllMedicareAssistances() 
    {
        return MedicareAssistance::all();
    }
    public function getMedicareAssistancesByType($type=null,$ma_id=null) 
    {
        return MedicareAssistance::where('medicare_assistance_type',$type)->where('id', '!=', $ma_id)->get(['id','name']);
    }

    public function getMedicareAssistanceById($MedicareAssistanceId) 
    {
        return MedicareAssistance::findOrFail($MedicareAssistanceId);
    }

    public function deleteMedicareAssistance($MedicareAssistanceId) 
    {
        MedicareAssistance::destroy($MedicareAssistanceId);
    }
    public function deleteBulkMedicareAssistance($MedicareAssistanceIds) 
    {
        MedicareAssistance::whereIn('id', $MedicareAssistanceIds)->delete();
    }

    public function createMedicareAssistance(array $MedicareAssistanceDetails) 
    {
        return MedicareAssistance::create($MedicareAssistanceDetails);
    }

    public function updateMedicareAssistance($MedicareAssistanceId, array $newDetails) 
    {
        return MedicareAssistance::whereId($MedicareAssistanceId)->update($newDetails);
    } 
}
