<?php

namespace AlexLathwell\Jetpack\Controllers;


use AlexLathwell\Jetpack\Traits\CallableTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as LaravelBaseController;

class Controller extends LaravelBaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, CallableTrait;

}