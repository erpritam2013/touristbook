<?php

namespace App\View\Composers;

use App\Interfaces\PropertyTypeRepositoryInterface;
use App\Models\Terms\PropertyType;
use Illuminate\View\View;

class PropertyTypeComposer
{

    public function __construct(private PropertyTypeRepositoryInterface $propertyTypeRepository) {}
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        
        $view->with('filterPropertyTypes', $this->propertyTypeRepository->getActivePropertyTypesList(PropertyType::HOTEL_TYPE));
    }
}
