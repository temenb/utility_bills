<?php

namespace App\Presenters;

//use App\Transformers\OrganizationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class OrganizationPresenter.
 *
 * @package namespace App\Presenters;
 */
class OrganizationPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new OrganizationTransformer();
    }
}
