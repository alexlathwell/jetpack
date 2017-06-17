<?php


namespace AlexLathwell\Jetpack\Traits;

use File;

trait ConfigAutoloadTrait
{
    public function loadModuleConfig($moduleName)
    {
        $configDirectory = app_path('Modules/' . $moduleName . '/Config');
        if (File::isDirectory($configDirectory)) {
            $files = File::allFiles($configDirectory);

            foreach ($files as $file) {
                $fileName = str_replace('.php', '', $file->getFilename());
                $this->mergeConfigFrom($file->getPathname(), $fileName);
            }
        }
    }
}