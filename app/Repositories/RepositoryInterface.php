<?php

namespace App\Repositories;

/**
 * Interface RepositoryInterface.
 *
 * @package namespace App\Repositories;
 */
interface RepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model();
}
