<?php

namespace App\Providers;

use App\View\Composers\ActivitiesComposer;
use App\View\Composers\AmenitiesComposer;
use App\View\Composers\BreadcrumbComposer;
use App\View\Composers\DealDiscountComposer;
use App\View\Composers\MedicareAssistanceComposer;
use App\View\Composers\MeetingAndEventsComposer;
use App\View\Composers\PriceComposer;
use App\View\Composers\DurationComposer;
use App\View\Composers\TourPriceComposer;
use App\View\Composers\PropertyTypeComposer;
use App\View\Composers\PackageTypeComposer;
use App\View\Composers\TypesComposer;
use App\View\Composers\ReviewScoreComposer;
use App\View\Composers\TermActivityListComposer;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
// use Illuminate\View\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ...
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Using class based composers...
        Facades\View::composer('admin.*', BreadcrumbComposer::class);

        View::composer(
            ['sites.partials.filters.priceFilter'],
            PriceComposer::class
        );
        View::composer(
            ['sites.partials.filters.reviewScoreFilter'],
            ReviewScoreComposer::class
        );
        View::composer(
            ['sites.partials.filters.activityListFilter'],
            TermActivityListComposer::class
        );
         View::composer(
            ['sites.partials.filters.durationFilter'],
            DurationComposer::class
        );
        View::composer(
            ['sites.partials.filters.tourPriceFilter'],
            TourPriceComposer::class
        );

        View::composer(
            ['sites.partials.filters.propertyTypeFilter'],
            PropertyTypeComposer::class
        );
        View::composer(
            ['sites.partials.filters.packageTypeFilter'],
            PackageTypeComposer::class
        );

        View::composer(
            ['sites.partials.filters.amenitiesFilter'],
            AmenitiesComposer::class
        );

        View::composer(
            ['sites.partials.filters.medicareAssistanceFilter'],
            MedicareAssistanceComposer::class
        );

        View::composer(
            ['sites.partials.filters.meetingAndEventsFilter'],
            MeetingAndEventsComposer::class
        );

        View::composer(
            ['sites.partials.filters.dealDiscountFilter'],
            DealDiscountComposer::class
        );

        View::composer(
            ['sites.partials.filters.activitiesFilter'],
            ActivitiesComposer::class
        );
        View::composer(
            ['sites.partials.filters.typsFilter'],
            TypesComposer::class
        );





        // Using closure based composers...
        // Facades\View::composer('welcome', function (View $view) {
        //     // ...
        // });

        // Facades\View::composer('dashboard', function (View $view) {
        //     // ...
        // });
    }
}
