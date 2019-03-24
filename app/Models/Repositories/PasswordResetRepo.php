<?php

namespace App\Models\Repositories;

use App\Models\Entities\PasswordReset;

/**
 * Interface PasswordResetRepository.
 *
 * @package namespace App\Models\Repositories;
 */
abstract class PasswordResetRepo extends BaseRepo
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PasswordReset::class;
    }
}
