<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\MasterRepositoryInterface;
use App\Repositories\MasterRepository;

use App\Interfaces\MartialProductRepositoryInterface;

use App\Repositories\MartialProductRepository;

 
use App\Repositories\BarCodeLabelRepository;
use App\Interfaces\BarCodeLabelRepositoryInterface;
use App\Interfaces\DsoRepositoryInterface;
use App\Interfaces\SearchRepositoryInterface;
use App\Repositories\DsoRepository;
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

        $this->app->bind(BarCodeLabelRepositoryInterface::class, BarCodeLabelRepository::class); 

        $this->app->bind(DsoRepositoryInterface::class, DsoRepository::class); 

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
