<?php

namespace App\View\Composers;

use App\Interfaces\TermActivityRepositoryInterface;
use App\Models\Terms\TermActivity;
use Illuminate\View\View;

class ActivitiesComposer
{

    public function __construct(private TermActivityRepositoryInterface $termActivityRepository) {}
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('filterTermActivity', $this->termActivityRepository->getActiveTermActivitiesList(TermActivity::HOTEL_TYPE));
    }
}
