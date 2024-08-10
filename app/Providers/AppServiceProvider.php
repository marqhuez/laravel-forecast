<?php

namespace App\Providers;

use App\Domain\ForecastFetcherInterface;
use App\Infrastructure\ForecastFetcherAdapter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ForecastFetcherInterface::class, ForecastFetcherAdapter::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
