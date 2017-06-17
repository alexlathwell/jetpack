<?php

namespace AlexLathwell\Jetpack\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest as LaravelFormRequest;

abstract class Request extends LaravelFormRequest
{
    use RequestTrait;

    public function hasAccess(User $user = null)
    {
        $user = $user ? : $this->user();

        $access = array_merge(
            $this->hasAnyPermission($user),
            $this->hasAnyRole($user)
        );

        return empty($access) ? true : in_array(true, $access);
    }

    public function authorize()
    {
        return $this->hasAccess();
    }
}