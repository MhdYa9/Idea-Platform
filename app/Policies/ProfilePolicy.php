<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProfilePolicy
//don't forget to add this policy in providers file
{
    public function update(User $user,User $model): bool
    {
        return $user->is($model);
    }
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user,User $model): bool
    {
        return $user->is($model);
    }

}
