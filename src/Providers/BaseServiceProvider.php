<?php

namespace AlexLathwell\Jetpack\Providers;


use AlexLathwell\Jetpack\Traits\AliasesAutoloadTrait;
use AlexLathwell\Jetpack\Traits\ProvidersAutoloadTrait;
use Illuminate\Support\ServiceProvider;

class BaseServiceProvider extends ServiceProvider
{
    use ProvidersAutoloadTrait;
    use AliasesAutoloadTrait;

    public function boot()
    {
        $this->loadServiceProviders();
        $this->loadAliases();
    }

    public function register()
    {
        
    }

}