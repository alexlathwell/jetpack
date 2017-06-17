<?php


namespace AlexLathwell\Jetpack\Traits;

use File;

trait ViewsAutoloadTrait
{
    public function loadModuleViews($moduleName)
    {
        $viewsDirectory = app_path('Modules/' . $moduleName . '/Web/Views');
        if (File::isDirectory($viewsDirectory)) {
            $this->loadViewsFrom($viewsDirectory, strtolower($moduleName));
        }
    }
}