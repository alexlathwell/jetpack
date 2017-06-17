<?php


namespace AlexLathwell\Jetpack\Traits;


use AlexLathwell\Jetpack\Facades\Jetpack;

trait AutoloaderTrait
{
    use HelpersAutoloadTrait;
    use ProvidersAutoloadTrait;
    use MigrationsAutoloadTrait;
    use ConfigAutoloadTrait;
    use LocalizationAutoloadTrait;
    use ViewsAutoloadTrait;

    public function runAutoloaders()
    {
        foreach (Jetpack::getModuleNames() as $moduleName) {
            $this->loadModuleHelpers($moduleName);
            $this->loadMainServiceProvider($moduleName);
            $this->loadModuleMigrations($moduleName);
            $this->loadModuleConfig($moduleName);
            $this->loadModuleLang($moduleName);
            $this->loadModuleViews($moduleName);
        }
    }
}