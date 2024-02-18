<?php

namespace App\View\Composers;

use App\Interfaces\DealsDiscountRepositoryInterface;
use App\Models\Terms\DealsDiscount;
use Illuminate\View\View;

class DealDiscountComposer
{

    public function __construct(private DealsDiscountRepositoryInterface $dealDiscountRepository) {}
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('filterDealDiscount', $this->dealDiscountRepository->getActiveHotelDealsDiscountsListFilter(DealsDiscount::HOTEL_TYPE));
    }
}
