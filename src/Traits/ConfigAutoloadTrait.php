<?php


namespace AlexLathwell\Jetpack\Traits;

use File;

trait ConfigAutoloadTrait
{
    public function loadModuleConfig($moduleName)
    {
        $configDirectory = config('jetpack.modules_path') . '/' . $moduleName . '/Config';
        if (File::isDirectory($configDirectory)) {
            $files = File::allFiles($configDirectory);

            foreach ($files as $file) {
                $fileName = str_replace('.php', '', $file->getFilename());
                $this->mergeConfigFrom($file->getPathname(), $fileName);
            }
        }
    }
}