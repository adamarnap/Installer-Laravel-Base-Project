<?php

namespace App\Traits;

use App\Enums\RoleEnum;

trait CanImpersonate
{
    /**
     * For check if user can impersonate other user.
     */
    public function canImpersonate(): bool
    {
        // Only user with role DEVELOPER can impersonate other users
        if (method_exists($this, 'hasRole')) {
            return $this->hasRole([RoleEnum::DEVELOPER->value]);
        }

        return false;
    }
}