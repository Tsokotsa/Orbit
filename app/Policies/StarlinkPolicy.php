<?php

namespace App\Policies;

use App\Models\User;

class StarlinkPolicy
{
    public function viewAccount(User $user)
    {
        return $user->can('view starlink account');
    }

    public function viewSubscriber(User $user)
    {
        return $user->can('view starlink subscriber');
    }

    public function activateLine(User $user)
    {
        return $user->can('activate starlink line');
    }

    public function deactivateLine(User $user)
    {
        return $user->can('deactivate starlink line');
    }

    public function topUp(User $user)
    {
        return $user->can('topup starlink line');
    }
}