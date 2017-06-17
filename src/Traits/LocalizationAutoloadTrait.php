<?php


namespace AlexLathwell\Jetpack\Traits;

use File;

trait LocalizationAutoloadTrait
{
    public function loadModuleLang($moduleName)
    {
        $localsDirectory = config('jetpack.modules_path') . '/' . $moduleName . '/Lang';
        if (File::isDirectory($localsDirectory)) {
            $this->loadTranslationsFrom($localsDirectory, strtolower($moduleName));
        }
    }
}