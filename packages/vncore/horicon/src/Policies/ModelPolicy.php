<?php

namespace VNCore\Horicon\Policies;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ModelPolicy
{
    /**
     * @param User  $user
     * @param Model $item
     *
     * @return bool
     */
    public function update(User $user, Model $item)
    {
        if (is_null($item->user_id)) {
            return TRUE;
        }

        return $user->id === $item->user_id;
    }
}