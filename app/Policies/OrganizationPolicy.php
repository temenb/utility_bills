<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Entities\Organization;
use App\Models\Entities\User;
use Auth;

class OrganizationPolicy
{
    use HandlesAuthorization, CommonFlowTrait;
}
