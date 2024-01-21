<?php

namespace App\Repositories;

use App\Interfaces\MedicareAssistanceRepositoryInterface;
use App\Models\Terms\MedicareAssistance;
use App\Models\Setting;
use App\Models\Page;

class MedicareAssistanceRepository implements MedicareAssistanceRepositoryInterface 
{

    private $commanMedicareAssistance = null;
    public function __construct()
    {
        $page_id = Setting::get_setting('hotel_list_page');
        if (!empty($page_id)) {   
        $page = Page::find($page_id);
          if (isset($page->extra_data['hotel_common_medicare_assistance'])) {
              $this->commanMedicareAssistance = $page->extra_data['hotel_common_medicare_assistance'];
          }
        }

    }
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
        if (!empty($this->commanMedicareAssistance)) {
        $medicareBuilder = MedicareAssistance::orderBy('name','asc')->where('status', MedicareAssistance::ACTIVE)->whereIn('id',$this->commanMedicareAssistance);
        }else{

        $medicareBuilder = MedicareAssistance::orderBy('name','asc')->where('status', MedicareAssistance::ACTIVE);
        }

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
