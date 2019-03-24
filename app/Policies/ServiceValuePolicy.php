<?php

namespace App\Policies;

use App\Models\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServiceValuePolicy
{
    use HandlesAuthorization, CommonFlowTrait;
}
