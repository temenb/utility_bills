<?php
/**
 * Created by PhpStorm.
 * User: temenb
 * Date: 3/7/19
 * Time: 7:22 AM
 */

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

class OrganizationRepository extends BaseRepository {

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return \App\Entities\Organization::class;
    }
}
