<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema; // Ne pas oublier d'ajouter cette ligne !

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Ajoute cette ligne pour corriger l'erreur de longueur de clé
        Schema::defaultStringLength(191);
    }
}