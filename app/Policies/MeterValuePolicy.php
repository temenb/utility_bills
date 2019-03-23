<?php

namespace App\Policies;

use App\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MeterValuePolicy
{
    use HandlesAuthorization, CommonFlowTrait;
}
