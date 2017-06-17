<?php

namespace AlexLathwell\Jetpack\Traits;


use File;

trait HelpersAutoloadTrait
{
    public function loadModuleHelpers($moduleName)
    {
        $helpersPath = app_path('Modules/' . $moduleName . '/Helpers');
        if (File::isDirectory($helpersPath)) {
            $files = File::allFiles($helpersPath);
            foreach ($files as $file) {
                require $file;
            }
        }
    }
}