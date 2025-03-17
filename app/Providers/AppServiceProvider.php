<?php

namespace App\Providers;
use App\Support\Storage\SessionStorage; // Change to the correct implementation
use App\Support\Storage\Contracts\StorageInterface;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use App\Support\Storage\ConcreteStorage;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Schema::defaultStringLength(191);


        $this->app->bind(StorageInterface::class, SessionStorage::class);



    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        require_once app_path('Helper/general.php');

    }
}
