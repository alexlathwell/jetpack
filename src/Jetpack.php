<?php

namespace AlexLathwell\Jetpack;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class Jetpack
{
    public function getModuleNamespace()
    {
        return config('jetpack.namespace');
    }

    public function getModuleNames()
    {
        $moduleNames = [];
        foreach ($this->getModulePaths() as $modulePath) {
            $moduleNames[] = basename($modulePath);
        }

        return $moduleNames;
    }

    public function getModulePaths()
    {
        return File::directories(config('jetpack.modules_path'));
    }

    public function getFullClassNameFromFile($classFilePath)
    {
        return $this->getClassNamespaceFromFile($classFilePath) . '\\' . $this->getClassNameFromFile($classFilePath);
    }

    protected function getClassNameFromFile($classFilePath) {
        $src = file_get_contents($classFilePath);

        $classes = array();
        $tokens = token_get_all($src);
        $count = count($tokens);
        for ($i = 2; $i < $count; $i++) {
            if (   $tokens[$i - 2][0] == T_CLASS
                && $tokens[$i - 1][0] == T_WHITESPACE
                && $tokens[$i][0] == T_STRING) {

                $class_name = $tokens[$i][1];
                $classes[] = $class_name;
            }
        }
        return $classes[0];
    }

    protected function getClassNamespaceFromFile ($classFilePath) {
        $src = file_get_contents($classFilePath);

        $tokens = token_get_all($src);
        $count = count($tokens);
        $i = 0;
        $namespace = '';
        $namespace_ok = false;
        while ($i < $count) {
            $token = $tokens[$i];
            if (is_array($token) && $token[0] === T_NAMESPACE) {
                // Found namespace declaration
                while (++$i < $count) {
                    if ($tokens[$i] === ';') {
                        $namespace_ok = true;
                        $namespace = trim($namespace);
                        break;
                    }
                    $namespace .= is_array($tokens[$i]) ? $tokens[$i][1] : $tokens[$i];
                }
                break;
            }
            $i++;
        }
        if (!$namespace_ok) {
            return null;
        } else {
            return $namespace;
        }
    }

}