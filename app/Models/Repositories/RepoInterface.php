<?php

namespace App\Models\Repositories;

/**
 * Interface RepositoryInterface.
 *
 * @package namespace App\Models\Repositories;
 */
interface RepoInterface
{
    public function rules($scenario = null, $type = '');
}
