<?php

namespace App\Traits;

use App\Enums\RoleEnum;

trait CanBeImpersonated
{
    /**
     * For check if user can be impersonated by other user.
     */
    public function canBeImpersonated(): bool
    {
        // Default: user with role 'developer' cannot be impersonated
        if (method_exists($this, 'hasRole')) {
            return ! $this->hasRole(RoleEnum::DEVELOPER->value);
        }

        return true;
    }
}