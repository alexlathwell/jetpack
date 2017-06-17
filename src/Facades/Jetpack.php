<?php

namespace AlexLathwell\Jetpack\Facades;


use Illuminate\Support\Facades\Facade;

class Jetpack extends Facade
{
    protected static function getFacadeAccessor() {
        return 'jetpack';
    }
}