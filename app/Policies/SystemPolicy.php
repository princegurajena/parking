<?php

namespace App\Policies;

use App\System;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SystemPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */

    public function admin(User $user)
    {
        return $user->role === 'admin';
    }


}
