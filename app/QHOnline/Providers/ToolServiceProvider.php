<?php

namespace App\QHOnline\Providers;

use Illuminate\Support\ServiceProvider;
use App\QHOnline\ToolFactory;

class ToolServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    public function register()
    {
        $this->app->singleton(ToolFactory::class, function () {
            return new ToolFactory();
        });
    }
}
