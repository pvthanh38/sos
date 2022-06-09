<?php

namespace VNCore\Horicon\Observers;

use App\User;

class UserObserver
{
    /**
     * @param User $user
     */
    public function deleted(User $user)
    {
        //
    }
}