<?php

namespace App\Policies;

use App\Models\Sport;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SportPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    function update(User $user, Sport $sport) {
        return $user->id === $sport->user_id || $user->isAdmin;
    }

    function delete(User $user, Sport $sport) {
        return $user->id === $sport->user_id || $user->isAdmin;
    }

    function create(User $user) {
        return true;
    }
}
