<?php

namespace App\Providers;

use App\Interfaces\FacilityRepositoryInterface;
use App\Repositories\FacilityRepository;
use App\Interfaces\AmenityRepositoryInterface;
use App\Repositories\AmenityRepository;
use App\Interfaces\MedicareAssistanceRepositoryInterface;
use App\Repositories\MedicareAssistanceRepository;
use App\Interfaces\HotelRepositoryInterface;
use App\Repositories\HotelRepository;
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
        $this->app->bind(HotelRepositoryInterface::class, HotelRepository::class);

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
