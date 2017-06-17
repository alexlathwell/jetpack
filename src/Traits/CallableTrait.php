<?php

namespace AlexLathwell\Jetpack\Traits;

use Illuminate\Support\Facades\App;

trait CallableTrait
{
    public function call($class, $args = [], $methods = [])
    {
        $action = App::make($class);

        foreach ($methods as $methodInfo) {
            if (is_array($methodInfo)) {
                $method = key($methodInfo);
                $args = $methodInfo[$method];
                if (method_exists($action, $method)) {
                    $action->$method(...$args);
                }
            } else {
                if (method_exists($action, $methodInfo)) {
                    $action->$methodInfo();
                }
            }
        }

        return $action->run(...$args);
    }
}