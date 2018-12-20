<?php

namespace ARJUN\ADMIN;

use Illuminate\Support\ServiceProvider;

class ADMINSERVICEPROVIDER extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $this->loadRoutesFrom(__DIR__ . '/ROUTES/web.php');
        $this->loadViewsFrom(__DIR__ . '/VIEWS', 'admin');
        $this->loadMigrationsFrom(__DIR__ . '/MIGRATIONS');
        $this->mergeConfigFrom(__DIR__ . '/CONFIG/auth.php', 'admin');
        $this->mergeConfigFrom(__DIR__ . '/CONFIG/app.php', 'admin');
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register() {
        
    }

}

?>