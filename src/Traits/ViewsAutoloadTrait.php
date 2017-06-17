<?php


namespace AlexLathwell\Jetpack\Traits;

use File;

trait ViewsAutoloadTrait
{
    public function loadModuleViews($moduleName)
    {
        $viewsDirectory = config('jetpack.modules_path') . '/' . $moduleName . '/Web/Views';
        if (File::isDirectory($viewsDirectory)) {
            $this->loadViewsFrom($viewsDirectory, strtolower($moduleName));
        }
    }
}