<?php
namespace Xxstop\LaravelElastica;

use Illuminate\Foundation\Application as LaravelApplication;
use \Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{

    public function boot()
    {
        $this->setUpConfig();
    }

    public function register()
    {
        $app = $this->app;

        $app->singleton('elastica', function($app) {
            return new Manager($app);
        });

        $app->alias('elastica', Manager::class);
    }

    protected function setUpConfig()
    {
        $source = dirname(__DIR__) . '/config/elastica.php';

        if ($this->app instanceof LaravelApplication) {
            $this->publishes([$source => config_path('elastica.php')], 'config');
        }

        $this->mergeConfigFrom($source, 'elastica');
    }

}