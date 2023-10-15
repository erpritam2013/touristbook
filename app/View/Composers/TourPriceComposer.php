<?php

namespace App\View\Composers;

use Illuminate\View\View;

class TourPriceComposer
{

    private $priceRanges = [];

    /**
     * Create a new profile composer.
     */
    public function __construct() {}

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $currency = '₹'; // Will be Fetched from Session

        $this->priceRanges = [
            [
                'value' => '0;10000',
                'symbol' => $currency,
                'min' => 0,
                'max' => 10000,
                'step' => 0,
                'label' => 'Below  '.$currency.'10000'
            ],
            [
                'value' => '10000;19999',
                'symbol' => $currency,
                'min' => 10000,
                'max' => 19999,
                'step' => 0,
                'label' => $currency.'10000'.'-'.$currency.'20000'
            ],
            [
                'value' => '30000;39999',
                'symbol' => $currency,
                'min' => 20000,
                'max' => 29999,
                'step' => 0,
                'label' => $currency.'20000'.'-'.$currency.'30000'
            ],
            [
                'value' => '30000;39999',
                'symbol' => $currency,
                'min' => 30000,
                'max' => 39999,
                'step' => 0,
                'label' => $currency.'30000'.'-'.$currency.'40000'
            ],
            [
                'value' => '40000;49999',
                'symbol' => $currency,
                'min' => 40000,
                'max' => 49999,
                'step' => 0,
                'label' => $currency.'40000'.'-'.$currency.'50000'
            ],
            [
                'value' => '0;50000',
                'symbol' => $currency,
                'min' => 0,
                'max' => 50000,
                'step' => 0,
                'label' => 'Up to '.$currency.'50000'
            ]
        ];

        $view->with('filtertourPriceRanges', $this->priceRanges);
    }
}
