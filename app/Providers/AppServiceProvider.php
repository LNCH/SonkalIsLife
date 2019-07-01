<?php

namespace App\Providers;

use App\Repositories\Patterns\DbPatternsRepository;
use App\Repositories\Patterns\PatternsRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(PatternsRepository::class, DbPatternsRepository::class);
    }
}
