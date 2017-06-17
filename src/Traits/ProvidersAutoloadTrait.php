<?php


namespace AlexLathwell\Jetpack\Traits;

use AlexLathwell\Jetpack\Facades\Jetpack;
use App;
use File;

trait ProvidersAutoloadTrait
{
    public function loadMainServiceProvider($moduleName)
    {
        $moduleProvidersDirectory = app_path('Modules/' . $moduleName . '/Providers/' . $moduleName . 'ServiceProvider.php');
        $mainProviderFiles = File::glob($moduleProvidersDirectory);
        if ($mainProviderFiles) {
            $mainProviderPath = Jetpack::getFullClassNameFromFile(reset($mainProviderFiles));
            $this->loadProvider($mainProviderPath);
        }
    }

    private function loadProvider($providerName)
    {
        App::register($providerName);
    }

    public function loadServiceProviders()
    {
        if(isset($this->providers)){
            foreach ($this->providers as $provider) {
                $this->loadProvider($provider);
            }
        }
    }
}