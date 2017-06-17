<?php


namespace AlexLathwell\Jetpack\Traits;

use File;

trait LocalizationAutoloadTrait
{
    public function loadModuleLang($moduleName)
    {
        $localsDirectory = app_path('Modules/' . $moduleName . '/Lang');
        if (File::isDirectory($localsDirectory)) {
            $this->loadTranslationsFrom($localsDirectory, strtolower($moduleName));
        }
    }
}