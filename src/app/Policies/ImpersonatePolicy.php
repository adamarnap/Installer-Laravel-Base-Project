<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ImpersonatePolicy
{
    use HandlesAuthorization;

    /**
     * Tentukan apakah user bisa melakukan impersonate pada user lain.
     */
    public function impersonate(User $currentUser, User $targetUser): bool
    {
        // Harus bisa impersonate
        if (! method_exists($currentUser, 'canImpersonate') || ! $currentUser->canImpersonate()) {
            return false;
        }

        // Target harus bisa di-impersonate
        if (method_exists($targetUser, 'canBeImpersonated') && ! $targetUser->canBeImpersonated()) {
            return false;
        }

        // Tidak boleh impersonate diri sendiri
        return $currentUser->id !== $targetUser->id;
    }
}