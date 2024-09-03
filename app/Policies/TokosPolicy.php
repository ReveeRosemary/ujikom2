<?php

namespace App\Policies;

use App\Models\Tokos;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TokosPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole(['Admin']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Tokos $tokos): bool
    {
        return $user->hasRole(['Admin']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole(['Admin']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Tokos $tokos): bool
    {
        return $user->hasRole(['Admin']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Tokos $tokos): bool
    {
        return $user->hasRole(['Admin']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Tokos $tokos): bool
    {
        return $user->hasRole(['Admin']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Tokos $tokos): bool
    {
        return $user->hasRole(['Admin']);
    }
}
