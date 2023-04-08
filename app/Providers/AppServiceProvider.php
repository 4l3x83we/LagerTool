<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Rawilk\FormComponents\Components\Label;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(Label::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
