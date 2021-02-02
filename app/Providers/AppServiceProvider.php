<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\View\Components\Card;
use App\View\Components\CardButton;
use Illuminate\Support\Facades\Blade;
use Carbon\Carbon;

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
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        Blade::component('components.card', Card::class);
        Blade::component('components.card-button', CardButton::class);
    }
}
