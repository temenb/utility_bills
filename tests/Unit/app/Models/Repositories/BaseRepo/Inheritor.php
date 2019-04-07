<?php
/**
 * Created by PhpStorm.
 * User: temenb
 * Date: 4/7/19
 * Time: 8:35 PM
 */

namespace Tests\Unit\app\Models\Repositories\BaseRepo;


use App\Models\Repositories\BaseRepo;

class Inheritor extends BaseRepo
{
    /**
     * @return array
     */
    public function alternativeRules() {
        return $this->prepareRules([], 'fake');
    }
}