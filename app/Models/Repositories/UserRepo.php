<?php

namespace App\Models\Repositories;

use App\Models\Entities\User;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Models\Repositories;
 */
abstract class UserRepo extends BaseRepo
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }
}
