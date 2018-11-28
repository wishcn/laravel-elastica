<?php
namespace Xxstop\LaravelElastica;

use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{

    public function boot()
    {
        $this->setUpConfig();
    }

    public function register()
    {
        $app = $this->app;

        $app->singleton('elasticsearch', function($app) {
            return new Manager($app);
        });

        $app->alias('elasticsearch', Manager::class);
    }

    protected function setUpConfig()
    {
        $source = dirname(__DIR__) . '/config/elastica.php';

        if ($this->app instanceof LaravelApplication) {
            $this->publishes([$source => config_path('elasticsearch.php')], 'config');
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('elasticsearch');
        }

        $this->mergeConfigFrom($source, 'elasticsearch');
    }

}