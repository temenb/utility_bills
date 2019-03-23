<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Entities\Organization;
use App\Entities\User;
use Auth;

class OrganizationPolicy
{
    use HandlesAuthorization, CommonFlowTrait;
}
