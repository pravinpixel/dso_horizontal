<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\MasterRepositoryInterface;
use App\Repositories\MasterRepository;

use App\Interfaces\MartialProductRepositoryInterface;

use App\Repositories\MartialProductRepository;

 
use App\Interfaces\DsoRepositoryInterface;
use App\Interfaces\SearchRepositoryInterface;
use App\Interfaces\ExportRepositoryInterface;
use App\Repositories\DsoRepository;
use App\Repositories\SearchRepository;
use App\Repositories\SearchRepositoryExport;
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
          $this->app->bind(ExportRepositoryInterface::class, SearchRepositoryExport::class); 


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
