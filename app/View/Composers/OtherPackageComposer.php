<?php

namespace App\View\Composers;

use App\Interfaces\OtherPackageRepositoryInterface;
use App\Models\Terms\OtherPackage;
use Illuminate\View\View;

class OtherPackageComposer
{

    public function __construct(private OtherPackageRepositoryInterface $otherPackageRepository) {}
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('filterOtherPackage', $this->otherPackageRepository->getActiveTourOtherPackagesWithParentSeprated(OtherPackage::TOUR_TYPE));
    }
}