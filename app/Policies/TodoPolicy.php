<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Board;

class TodoPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(User $user) {
        return true;
    }
}
