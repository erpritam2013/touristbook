<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\FacilityRepositoryInterface;
use App\Repositories\FacilityRepository;
use App\Interfaces\AmenityRepositoryInterface;
use App\Repositories\AmenityRepository;
use App\Interfaces\MedicareAssistanceRepositoryInterface;
use App\Repositories\MedicareAssistanceRepository;

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
