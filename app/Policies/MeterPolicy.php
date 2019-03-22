<?php

namespace App\Policies;

use App\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MeterPolicy
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
