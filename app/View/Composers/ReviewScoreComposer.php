<?php

namespace App\View\Composers;

use Illuminate\View\View;

class ReviewScoreComposer
{

    private $reviewScore = [];

    /**
     * Create a new profile composer.
     */
    public function __construct() {}

    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {

        $this->reviewScore = [
            [
                'value' => 5,
                'fake' => 0,
            ],
            [
                'value' => 4,
                'fake' => 1,


            ],
            [
                'value' => 3,
                'fake' => 2,


            ],
            [
                'value' => 2,
                'fake' => 3,


            ],
            [
                'value' => 1,
                'fake' => 4,


            ],
        ];

        $view->with('filterReviewScore', $this->reviewScore);
    }
}
