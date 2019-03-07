<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\MeterValueRepository;
use App\Entities\MeterValue;
use App\Validators\MeterValueValidator;

/**
 * Class MeterValueRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MeterValueRepositoryEloquent extends BaseRepository implements MeterValueRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MeterValue::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
