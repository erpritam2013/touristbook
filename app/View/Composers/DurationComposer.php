<?php

namespace App\View\Composers;

use Illuminate\View\View;

class DurationComposer
{

    private $Duration = [];

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

        $this->Duration = [

            [
                'value' => '1 Days / 0 Night;2 Days / 1 Night',
                'label' => 'Up to 2D/1N'
            ], 
            [
                'value' => '3 Days / 2 Night',
                'label' => '3D/2N'
            ], 
            [
                'value' => '4 Days / 3 Night',
                'label' => '4D/3N'
            ], 
            [
                'value' => '5 Days / 4 Night',
                'label' => '5D/4N'
            ], 
            [
                'value' => '6 Days / 5 Night',
                'label' => '6D/5N'
            ], 
            [
                'value' => '7 Days / 6 Night',
                'label' => '7D/6N'
            ], 
            [
                'value' => '8 Days / 7 Night',
                'label' => '8D/7N'
            ], 
            [
                'value' => '9 Days / 8 Night',
                'label' => '9D/8N'
            ], 
            [
                'value' => '10 Days / 9 Night',
                'label' => '10D/9N'
            ], 
            [
                'value' => '10 Days / 9 Night;11 Days / 10 Night;12 Days / 11 Night;13 Days / 12 Night;14 Days / 13 Night;15 Days / 14 Night;16 Days / 15 Night;17 Days / 16 Night;18 Days / 17 Night;19 Days / 18 Night;20 Days / 19 Night;21 Days / 20 Night;22 Days / 21 Night;23 Days / 22 Night;24 Days / 23 Night;25 Days / 24 Night;26 Days / 25 Night;27 Days / 26 Night;28 Days / 27 Night;29 Days / 28 Night;30 Days / 29 Night',
                'label' => 'Above 10D/9N'
            ],
        ];

        $view->with('filterDuration', $this->Duration);
    }
}
