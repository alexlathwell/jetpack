<?php

namespace AlexLathwell\Jetpack;

use AlexLathwell\Jetpack\Providers\BaseServiceProvider;
use AlexLathwell\Jetpack\Providers\RouteServiceProvider;
use AlexLathwell\Jetpack\Traits\AutoloaderTrait;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Zizaco\Entrust\EntrustFacade;

class JetpackServiceProvider extends BaseServiceProvider
{
    use AutoloaderTrait;

    public $providers = [
        \Dingo\Api\Provider\LaravelServiceProvider::class,
        \Tymon\JWTAuth\Providers\LaravelServiceProvider::class,
        \Prettus\Repository\Providers\RepositoryServiceProvider::class,
        \Barryvdh\Cors\ServiceProvider::class,
        \Zizaco\Entrust\EntrustServiceProvider::class,

        RouteServiceProvider::class
    ];

    public $aliases = [
        'Entrust'   => EntrustFacade::class
    ];

    public function boot()
    {
        $path = realpath(__DIR__.'/../config/config.php');
        $this->publishes([$path => config_path('jetpack.php')], 'config');
        $this->mergeConfigFrom($path, 'jetpack');

        $this->runAutoloaders();
        parent::boot();
    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->alias(Jetpack::class, 'jetpack');
    }
}
