<?php

namespace App\View\Composers;

use App\Interfaces\TermActivityListRepositoryInterface;
use App\Models\Terms\TermActivityList;
use Illuminate\View\View;

class TermActivityListComposer
{

    public function __construct(private TermActivityListRepositoryInterface $termActivityListRepository) {}
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('filterTermActivityList', $this->termActivityListRepository->getActiveTermActivityListWithParentSeprated(TermActivityList::ACTIVITY_TYPE));
    }
}
