<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Organization;

/**
 * Class OrganizationTransformer.
 *
 * @package namespace App\Transformers;
 */
class OrganizationTransformer extends TransformerAbstract
{
    /**
     * Transform the Organization entity.
     *
     * @param \App\Entities\Organization $model
     *
     * @return array
     */
    public function transform(Organization $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
