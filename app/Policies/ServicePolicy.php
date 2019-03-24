<?php

namespace App\Policies;

use App\Models\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicePolicy
{
    use HandlesAuthorization, CommonFlowTrait;
}
