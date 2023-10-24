<?php

namespace App\Repositories;

use App\Interfaces\MedicareAssistanceRepositoryInterface;
use App\Models\Terms\MedicareAssistance;

class MedicareAssistanceRepository implements MedicareAssistanceRepositoryInterface 
{
    public function getAllMedicareAssistances() 
    {
        return MedicareAssistance::orderBy('id','desc')->get();
    }
    public function getMedicareAssistancesByType($type=null,$ma_id=null) 
    {
        $medicareAssistanceTypeBuilder = [];
        if (!empty($type)){
        $medicareAssistanceTypeBuilder = MedicareAssistance::where('status', MedicareAssistance::ACTIVE)->where('medicare_assistance_type',$type)->get(['id','name','parent_id']);
        }
        if (!empty($ma_id)){
        $medicareAssistanceTypeBuilder = MedicareAssistance::where('status', MedicareAssistance::ACTIVE)->where('id', '!=', $ma_id)->where('parent_id', '!=', $ma_id)->where('parent_id', 0)->get(['id','name','parent_id']);
        }

       return $medicareAssistanceTypeBuilder;
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


    // Get all Active Medicare Assistances or by Type
    public function getActiveMedicareAssistancesList($type = null) {
        $medicareBuilder = MedicareAssistance::orderBy('name','asc')->where('status', MedicareAssistance::ACTIVE);

        if($type)
            $medicareBuilder->where('medicare_assistance_type',$type);
        
        $medicare_assistances = $medicareBuilder->get(['id','name', 'parent_id']);

        $nestedResult = $medicare_assistances->toNested();

        return  $nestedResult;
    }

    // Get Active Hotel Type Medicare Assistances
    public function getActiveHotelMedicareAssistancesList() {
        $type = MedicareAssistance::HOTEL_TYPE;
        return $this->getActiveMedicareAssistancesList($type);
    }

}
