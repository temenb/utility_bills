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
    public static function extractUserId($user = null)
    {
        switch (true) {
            case is_null($user):
                $userId = auth()->check() ? auth()->user()->id : null;
                break;
            case $user instanceof User:
                $userId = $user->id;
                break;
            case is_integer($user):
                $userId = $user;
                break;
            default:
                throw new \Exception('User is not specified appropriately');
        }
        return $userId;
    }
}
