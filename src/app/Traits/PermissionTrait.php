<?php
namespace App\Traits;

use App\Enums\RoleEnum;

trait PermissionTrait
{
    // This function is used to check, role user has permission to access the page, if not, it will return 403 error
    protected function setRule($role=null) {
        auth()->user()->hasRole(RoleEnum::DEVELOPER->value) || auth()->user()->can($role) || abort(403);
    }
}
