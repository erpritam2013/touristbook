<?php

namespace App\Interfaces;

interface MedicareAssistanceRepositoryInterface 
{
    public function getAllMedicareAssistances();
    public function getMedicareAssistanceById($MedicareAssistanceId);
    public function deleteMedicareAssistance($MedicareAssistanceId);
    public function createMedicareAssistance(array $MedicareAssistanceDetails);
    public function updateMedicareAssistance($MedicareAssistanceId, array $newDetails);
    public function getMedicareAssistancesByType(string $type);
}
