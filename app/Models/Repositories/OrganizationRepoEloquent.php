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
        switch (true) {
            case is_null($user):
                $userId = auth()->user()->id;
                break;
            case $user instanceof User:
                $userId = $user->id;
                break;
            case is_integer($user):
                $userId = $user->id;
                break;
            default:
                throw new \Exception('User is not specified appropriately');
        }

        return Organization::where('owner_id', '=', $userId)->get();
    }

    /**
     * @param $organizations
     * @return array
     */
    public function calculateOrganizationRowspan($organizations): array
    {
        $lineCountForItemWithoutChild = 1;

        $organizationRowspan = [];
        foreach ($organizations as $organization) {
            $organizationRowspan[$organization->id] = $lineCountForItemWithoutChild;
            if (count($organization->services)) {
                $organizationRowspan[$organization->id] = 0;
                foreach ($organization->services as $service) {
                    $metersCount = count($service->meters);
                    $organizationRowspan[$organization->id] += $metersCount ?? $lineCountForItemWithoutChild;
                }
            }
        }
        return $organizationRowspan;
    }
}
