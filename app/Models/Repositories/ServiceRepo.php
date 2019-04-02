<?php

namespace App\Models\Repositories;

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
            'id' => 'required|int|exists:services,id',
            'name' => 'required|max:255',
        ];
    }

    protected function rulesSetSometimes() {
        return [
            'organization_id' =>  [
                'exists:organizations,id',
                function ($input) {
                    return $input->get('organization_id') != static::NEW_ORGANIZATION;
                }
            ],
        ];
    }

    public function rules($scenario = null, $type = '') {
        $rules = $this->getRules($type);

        switch ($scenario) {
//            case 'update':
//                return $this->prepareRules($rules, ['id', 'name', 'organization_id']);
            case 'create':
                return $this->prepareRules($rules, ['name', 'organization_id']);
//            case 'delete':
//                return $this->prepareRules($rules, 'id');
            default:
                return parent::prepareRules($rules);
        }
    }
}
