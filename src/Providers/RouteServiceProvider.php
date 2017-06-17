<?php

namespace AlexLathwell\Jetpack\Providers;

use AlexLathwell\Jetpack\Facades\Jetpack;
use App\Providers\RouteServiceProvider as LaravelRouteServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Finder\SplFileInfo;

class RouteServiceProvider extends LaravelRouteServiceProvider
{
    protected function mapWebRoutes()
    {
        $moduleNamespace = Jetpack::getModuleNamespaces();
        $modulePaths = Jetpack::getModulePaths();

        foreach ($modulePaths as $modulePath) {
            $routesPath = $modulePath . '/Web/Routes';
            $controllerNamespace  = $moduleNamespace . basename($modulePath) . '\\Web\Controllers';

            if (File::isDirectory($routesPath)) {
                $files = File::allFiles($routesPath);
                $files = array_sort($files, function($file) { return $file->getFilename(); });
                foreach ($files as $file) {
                    $this->loadWebRoute($file, $controllerNamespace);
                }
            }
        }
    }

    protected function mapApiRoutes()
    {
        $moduleNamespace = Jetpack::getModuleNamespaces();
        $modulePaths = Jetpack::getModulePaths();

        foreach ($modulePaths as $modulePath) {
            $routesPath = $modulePath . '/Api/Routes';
            $controllerNamespace  = $moduleNamespace . basename($modulePath) . '\\Api\Controllers';

            if (File::isDirectory($routesPath)) {
                $files = File::allFiles($routesPath);
                $files = array_sort($files, function($file) { return $file->getFilename(); });
                foreach ($files as $file) {
                    $this->loadApiRoute($file, $controllerNamespace);
                }
            }
        }
    }

    private function loadWebRoute($file, $controllerNamespace)
    {
        Route::group([
            'middleware' => 'web',
            'namespace' => $controllerNamespace,
        ], function ($router) use ($file) {
            require $file->getPathname();
        });
    }

    private function loadApiRoute($file, $controllerNamespace)
    {
        $api = app('Dingo\Api\Routing\Router');
        $version = $this->getRouteVersion($file);
        $path = $file->getPathname();

        $api->version($version, function ($api) use($controllerNamespace, $path, $version) {
            $api->group(['namespace' => $controllerNamespace, 'prefix' => $version], function ($api) use($path) {
                require $path;
            });
        });
    }

    private function getRouteVersion($file)
    {
        $filename = $this->getRouteFilename($file);
        $filenameExploded = explode('.', $filename);
        $apiVersion = reset($filenameExploded);

        if (empty($apiVersion)) {
            return 'v1';
        }

        return $apiVersion;
    }

    private function getRouteFilename(SplFileInfo $file)
    {
        $fileInfo = pathinfo($file->getFilename());
        return $fileInfo['filename'];
    }
}