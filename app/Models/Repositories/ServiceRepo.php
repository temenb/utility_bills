<?php

namespace App\Models\Repositories;

use App\Models\Entities\Service;

/**
 * Interface ServiceRepository.
 *
 * @package namespace App\Models\Repositories;
 */
abstract class ServiceRepo extends BaseRepo
{
    const NEW_ORGANIZATION = 'new';

    protected function rulesSet() {
        return [
            'id' => 'required|int',
            'name' => 'required|max:255',
            'organization_id' => 'required|exists:organizations,id',
        ];
    }

    protected function rulesSetSometimes() {
        return [
            'organization_id' =>  ['sometimes|exists:services,id', function ($input) {
                return $input->get('organization_id') != static::NEW_ORGANIZATION;
            }],
        ];
    }

    public function rules($scenario = null, $type = '') {
        $rules = static::getRules($type);

        switch ($scenario) {
//            case 'update':
//                $_rules = static::prepareRules($rules, ['id', 'name', 'organization_id']);
//                break;
            case 'create':
                $_rules = static::prepareRules($rules, ['name', 'organization_id']);
                break;
//            case 'delete':
//                $_rules = static::prepareRules($rules, 'id');
//                break;
            default:
                $_rules = static::prepareRules($rules);
        }
        return $_rules;
    }
}
