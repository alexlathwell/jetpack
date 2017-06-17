<?php

namespace AlexLathwell\Jetpack\Controllers;


use Dingo\Api\Exception\ResourceException;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;

abstract class ApiController extends Controller
{
    use Helpers;

    protected function throwValidationException(Request $request, $validator)
    {
        throw new ResourceException('Validation failed', $validator->getMessageBag());
    }

}