<?php

namespace App\Policies;

use App\Models\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MeterValuePolicy
{
    use HandlesAuthorization, CommonFlowTrait;
}
