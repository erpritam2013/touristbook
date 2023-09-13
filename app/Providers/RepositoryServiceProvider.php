<?php

namespace App\Providers;

use App\Interfaces\FacilityRepositoryInterface;
use App\Repositories\FacilityRepository;
use App\Interfaces\AmenityRepositoryInterface;
use App\Repositories\AmenityRepository;
use App\Interfaces\MedicareAssistanceRepositoryInterface;
use App\Repositories\MedicareAssistanceRepository;
use App\Interfaces\TopServiceRepositoryInterface;
use App\Repositories\TopServiceRepository;
use App\Interfaces\PlaceRepositoryInterface;
use App\Repositories\PlaceRepository;
use App\Interfaces\AccessibleRepositoryInterface;
use App\Repositories\AccessibleRepository;
use App\Interfaces\PropertyTypeRepositoryInterface;
use App\Repositories\PropertyTypeRepository;
use App\Interfaces\MeetingAndEventRepositoryInterface;
use App\Repositories\MeetingAndEventRepository;
use App\Interfaces\CountryRepositoryInterface;
use App\Repositories\CountryRepository;
use App\Interfaces\StateRepositoryInterface;
use App\Repositories\StateRepository;
use App\Interfaces\OccupancyRepositoryInterface;
use App\Repositories\OccupancyRepository;
use App\Interfaces\DealsDiscountRepositoryInterface;
use App\Repositories\DealsDiscountRepository;
use App\Interfaces\TermActivityRepositoryInterface;
use App\Repositories\TermActivityRepository;
use App\Interfaces\TypeRepositoryInterface;
use App\Repositories\TypeRepository;
use App\Interfaces\LocationRepositoryInterface;
use App\Repositories\LocationRepository;
use App\Interfaces\HotelRepositoryInterface;
use App\Repositories\HotelRepository;
use App\Interfaces\CountryZoneRepositoryInterface;
use App\Repositories\CountryZoneRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FacilityRepositoryInterface::class, FacilityRepository::class);
        $this->app->bind(AmenityRepositoryInterface::class, AmenityRepository::class);
        $this->app->bind(MedicareAssistanceRepositoryInterface::class, MedicareAssistanceRepository::class);
        $this->app->bind(TopServiceRepositoryInterface::class, TopServiceRepository::class);
        $this->app->bind(PlaceRepositoryInterface::class, PlaceRepository::class);
        $this->app->bind(AccessibleRepositoryInterface::class, AccessibleRepository::class);
        $this->app->bind(PropertyTypeRepositoryInterface::class, PropertyTypeRepository::class);
        $this->app->bind(MeetingAndEventRepositoryInterface::class, MeetingAndEventRepository::class);
        $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);
        $this->app->bind(OccupancyRepositoryInterface::class, OccupancyRepository::class);
        $this->app->bind(StateRepositoryInterface::class, StateRepository::class);
        $this->app->bind(DealsDiscountRepositoryInterface::class, DealsDiscountRepository::class);
        $this->app->bind(TermActivityRepositoryInterface::class, TermActivityRepository::class);
        $this->app->bind(LocationRepositoryInterface::class, LocationRepository::class);
        $this->app->bind(TypeRepositoryInterface::class, TypeRepository::class);
        $this->app->bind(HotelRepositoryInterface::class, HotelRepository::class);
        $this->app->bind(CountryZoneRepositoryInterface::class, CountryZoneRepository::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
