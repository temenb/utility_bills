<?php

namespace App\Models\Repositories;

/**
 * Interface RepositoryInterface.
 *
 * @package namespace App\Models\Repositories;
 */
interface RepoInterface
{
    public static function rules($scenario);
}
