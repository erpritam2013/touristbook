<?php

namespace App\View\Composers;

use App\Interfaces\AmenityRepositoryInterface;
use App\Models\Terms\Amenity;
use Illuminate\View\View;

class AmenitiesComposer
{

    public function __construct(private AmenityRepositoryInterface $amenityRepository) {}
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('filterAmenities', $this->amenityRepository->getActiveHotelAmenitiesListFilter(Amenity::HOTEL_TYPE));
    }
}
