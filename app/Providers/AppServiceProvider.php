<?php

namespace App\Providers;

use App\Models\Petugas;
use Illuminate\Support\Facades\Gate;
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
        Gate::define('admin', function(Petugas $petugas) {
            return $petugas->level === 'admin';
        });
        Gate::define('petugas', function(Petugas $petugas) {
            return $petugas->level === 'petugas';
        });
    }
}
