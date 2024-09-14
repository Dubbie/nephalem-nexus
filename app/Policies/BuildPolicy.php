<?php

namespace App\Policies;

use App\Models\Build;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class BuildPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Build $build): bool
    {
        // Check if build is published and approved
        if ($build->status === Build::STATUS_APPROVED) {
            return true;
        }

        // Check if user is admin or dev
        $permittedRoles = ['ADMIN', 'DEVELOPER'];
        if (in_array($user->role, $permittedRoles)) {
            return true;
        }

        return $build->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Build $build): bool
    {
        // Check if user is admin or dev
        $permittedRoles = ['ADMIN', 'DEVELOPER'];
        if (in_array($user->role, $permittedRoles)) {
            return true;
        }

        return $user->id === $build->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Build $build): bool
    {
        // Check if user is admin or dev
        $permittedRoles = ['ADMIN', 'DEVELOPER'];
        if (in_array($user->role, $permittedRoles)) {
            return true;
        }

        return $user->id === $build->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Build $build): bool
    {
        // Check if user is admin or dev
        $permittedRoles = ['ADMIN', 'DEVELOPER'];
        if (in_array($user->role, $permittedRoles)) {
            return true;
        }

        return $user->id === $build->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Build $build): bool
    {
        // Check if user is admin or dev
        $permittedRoles = ['ADMIN', 'DEVELOPER'];
        if (in_array($user->role, $permittedRoles)) {
            return true;
        }

        return $user->id === $build->user_id;
    }

    /**
     * Determine whether the user can approve the model.
     */
    public function approve(User $user): bool
    {
        $permittedRoles = ['ADMIN', 'DEVELOPER'];
        return in_array($user->role, $permittedRoles);
    }
}
