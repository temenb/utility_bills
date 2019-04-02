<?php

namespace App\Models\Repositories;

use App\Models\Entities\Organization;
use App\Models\Entities\User;

/**
 * Class OrganizationRepositoryEloquent.
 *
 * @package namespace App\Models\Repositories;
 */
class OrganizationRepoEloquent extends OrganizationRepo
{
    /**
     * @param null|int|User $user
     * @return mixed
     * @throws \Exception
     */
    public function getUserRelatedOrganizations($user = null)
    {
        $userId = resolve(UserRepo::class)->extractUserId($user);
        return Organization::where('owner_id', '=', $userId)->get();
    }
}
