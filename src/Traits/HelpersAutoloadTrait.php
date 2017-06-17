<?php

namespace AlexLathwell\Jetpack\Traits;


use File;

trait HelpersAutoloadTrait
{
    public function loadModuleHelpers($moduleName)
    {
        $helpersPath = config('jetpack.modules_path') . '/' . $moduleName . '/Helpers';
        if (File::isDirectory($helpersPath)) {
            $files = File::allFiles($helpersPath);
            foreach ($files as $file) {
                require $file;
            }
        }
    }
}