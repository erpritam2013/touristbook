<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Conversion;
use Illuminate\Support\Facades\Session;
class PriceComposer
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
        $currency = '₹';
        $priceObject = Conversion::where('currency_name', Session::get('currency'))->first();
        if(!empty($priceObject)){
            $currency = $priceObject->currency_symbol; // Will be Fetched from Session
        }

        $this->priceRanges = [
            [
                'value' => '0;999',
                'symbol' => $currency,
                'min' => 0,
                'max' => 999,
                'step' => 0,
                'label' => 'Less than '.get_price(1000)
            ],
            [
                'value' => '1000;2499',
                'symbol' => $currency,
                'min' => 1000,
                'max' => 2499,
                'step' => 0,
                'label' => get_price(1000).'-'.get_price(2500)
            ],
            [
                'value' => '2500;3999',
                'symbol' => $currency,
                'min' => 2500,
                'max' => 3999,
                'step' => 0,
                'label' => get_price(2500).'-'.get_price(4000)
            ],
            [
                'value' => '4000;5999',
                'symbol' => $currency,
                'min' => 4000,
                'max' => 5999,
                'step' => 0,
                'label' => get_price(4000).'-'.get_price(6000)
            ],
            [
                'value' => '6000;7499',
                'symbol' => $currency,
                'min' => 6000,
                'max' => 7499,
                'step' => 0,
                'label' => get_price(6000).'-'.get_price(7500)
            ],
            [
                'value' => '7500;9999',
                'symbol' => $currency,
                'min' => 7500,
                'max' => 9999,
                'step' => 0,
                'label' => get_price(7500).'-'.get_price(10000)
            ],
            [
                'value' => '10000;14999',
                'symbol' => $currency,
                'min' => 10000,
                'max' => 14999,
                'step' => 0,
                'label' => get_price(10000).'-'.get_price(15000)
            ],
            [
                'value' => '15000;34999',
                'symbol' => $currency,
                'min' => 15000,
                'max' => 34999,
                'step' => 0,
                'label' => get_price(15000).'-'.get_price(35000)
            ],
            [
                'value' => '35000;49999',
                'symbol' => $currency,
                'min' => 35000,
                'max' => 49999,
                'step' => 0,
                'label' => get_price(35000).'-'.get_price(50000)
            ],
            [
                'value' => '50000;99000',
                'symbol' => $currency,
                'min' => 50000,
                'max' => 99000,
                'step' => 0,
                'label' => 'More than '.get_price(50000)
            ]
        ];

        $view->with('filterPriceRanges', $this->priceRanges);
    }
}
