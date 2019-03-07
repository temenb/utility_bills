<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MeterRepository;
use App\Entities\Meter;
use App\Validators\MeterValidator;

/**
 * Class MeterRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MeterRepositoryEloquent extends BaseRepository implements MeterRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Meter::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
