<?php

namespace AlexLathwell\Jetpack\Requests;


trait RequestTrait
{
    private function hasAnyPermission($user)
    {

        if (!isset($this->access) || !array_key_exists('permissions', $this->access) || !$this->access['permissions']) {
            return [];
        }

        $permissions = $this->access['permissions'];

        $hasPermissions = array_map(function ($permission) use ($user) {
            return $user->can($permission);
        }, $permissions);

        return $hasPermissions;
    }

    private function hasAnyRole($user)
    {
        if (!isset($this->access) || !array_key_exists('roles', $this->access) || !$this->access['roles']) {
            return [];
        }

        $roles = $this->access['roles'];

        $hasRoles = array_map(function ($role) use ($user) {
            return $user->hasRole($role);
        }, $roles);

        return $hasRoles;
    }
}