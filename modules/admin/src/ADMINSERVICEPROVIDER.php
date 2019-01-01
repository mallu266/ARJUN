<?php

namespace ARJUN\ADMIN;

use ARJUN\ADMIN\FUNCTIONS\INVISIBLERECAPTCHA;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

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
        $this->mergeConfigFrom(__DIR__ . '/CONFIG/admin.php', 'admin');
        $this->mergeConfigFrom(__DIR__ . '/CONFIG/errorlog.php', 'errorlog');
        $this->mergeConfigFrom(__DIR__ . '/CONFIG/captcha.php', 'captcha');
        $this->bootConfig();
        $this->app['validator']->extend('captcha', function ($attribute, $value) {
            return $this->app['captcha']->verifyResponse($value, $this->app['request']->getClientIp());
        });
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register() {
        $this->app->singleton('captcha', function ($app) {
            return new INVISIBLERECAPTCHA(
                    $app['config']['captcha.siteKey'], $app['config']['captcha.secretKey'], $app['config']['captcha.options']
            );
        });

        $this->app->afterResolving('blade.compiler', function () {
            $this->addBladeDirective($this->app['blade.compiler']);
        });
    }

    protected function bootConfig() {
        $path = __DIR__ . '/CONFIG/captcha.php';
        $this->mergeConfigFrom($path, 'captcha');
        if (function_exists('config_path')) {
            $this->publishes([$path => config_path('captcha.php')]);
        }
    }

    public function addBladeDirective(BladeCompiler $blade) {
        $blade->directive('captcha', function ($lang) {
            return "<?php echo app('captcha')->render({$lang}); ?>";
        });
    }

}

?>