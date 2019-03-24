<?php

namespace App\Models\Repositories;

/**
 * Interface RepositoryInterface.
 *
 * @package namespace App\Models\Repositories;
 */
interface RepoInterface
{
    public function model();

    public static function rules($scenario);
}
