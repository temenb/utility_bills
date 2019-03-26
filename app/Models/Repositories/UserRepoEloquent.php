<?php

namespace App\Models\Repositories;

use App\Models\Entities\User;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Models\Repositories;
 */
class UserRepoEloquent extends UserRepo
{
    /**
     * @param $user
     * @return int
     * @throws \Exception
     */
    public static function extractUserId($user): int
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
        return $userId;
    }
}
