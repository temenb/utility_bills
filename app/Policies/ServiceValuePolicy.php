<?php

namespace App\Policies;

use App\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServiceValuePolicy
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
}
