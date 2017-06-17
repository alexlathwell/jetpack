<?php

namespace AlexLathwell\Jetpack\Traits;

use File;

trait MigrationsAutoloadTrait
{
    public function loadModuleMigrations($moduleName)
    {
        $migrationsDirectory = config('jetpack.modules_path') . '/' . $moduleName . '/Migrations';

        if (File::isDirectory($migrationsDirectory)) {
            $this->loadMigrationsFrom($migrationsDirectory);
        }
    }
}