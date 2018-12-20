<?php

namespace ARJUN\CKEDITOR;

use Illuminate\Support\ServiceProvider;

class CKEDITORSERVICEPROVIDER extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $this->loadRoutesFrom(__DIR__ . '/ROUTES/web.php');
        $this->loadViewsFrom(__DIR__ . '/VIEWS', 'ckeditor');
        $this->loadMigrationsFrom(__DIR__ . '/MIGRATIONS');
        $this->mergeConfigFrom(__DIR__ . '/CONFIG/auth.php', 'ckeditor');
        $this->mergeConfigFrom(__DIR__ . '/CONFIG/app.php', 'ckeditor');
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