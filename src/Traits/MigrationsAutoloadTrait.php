<?php

namespace AlexLathwell\Jetpack\Traits;

use File;

trait MigrationsAutoloadTrait
{
    public function loadModuleMigrations($moduleName)
    {
        $migrationsDirectory = app_path('Modules/' . $moduleName . '/Migrations');

        if (File::isDirectory($migrationsDirectory)) {
            $this->loadMigrationsFrom($migrationsDirectory);
        }
    }
}