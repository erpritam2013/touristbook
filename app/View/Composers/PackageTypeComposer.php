<?php

namespace App\View\Composers;

use App\Interfaces\PackageTypeRepositoryInterface;
use App\Models\Terms\PackageType;
use Illuminate\View\View;

class PackageTypeComposer
{

    public function __construct(private PackageTypeRepositoryInterface $packageTypeRepository) {}
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {

        if ($view->post_type == 'Hotel') {
            $view->with('filterpackageTypes', $this->packageTypeRepository->getActivePackageTypesList(PackageType::HOTEL_TYPE));
        }

        if ($view->post_type == 'Tour') {
            $view->with('filterpackageTypes', $this->packageTypeRepository->getActivePackageTypesList(PackageType::TOUR_TYPE));
        }
        
    }
}
