<?php

namespace App\Policies;

use App\Models\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MeterPolicy
{
    use HandlesAuthorization, CommonFlowTrait;
}
