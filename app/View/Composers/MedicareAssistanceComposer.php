<?php

namespace App\View\Composers;

use App\Interfaces\MedicareAssistanceRepositoryInterface;
use App\Models\Terms\MedicareAssistance;
use Illuminate\View\View;

class MedicareAssistanceComposer
{

    public function __construct(private MedicareAssistanceRepositoryInterface $medicareRepository) {}
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('filterMedicare', $this->medicareRepository->getActiveHotelMedicareAssistancesListFilter(MedicareAssistance::HOTEL_TYPE));
    }
}
