<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\MasterRepositoryInterface;
use App\Repositories\MasterRepository;

use App\Interfaces\MartialProductRepositoryInterface;
use App\Repositories\MartialProductRepository;


use App\Interfaces\SearchRepositoryInterface;
use App\Repositories\SearchRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MasterRepositoryInterface::class, MasterRepository::class);
        
        $this->app->bind(MartialProductRepositoryInterface::class, MartialProductRepository::class);

        $this->app->bind(SearchRepositoryInterface::class, SearchRepository::class); 
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
