<?php

namespace App\Models\Repositories;

/**
 * Interface OrganizationRepository.
 *
 * @package namespace App\Models\Repositories;
 */
abstract class OrganizationRepo extends BaseRepo
{
    protected function rulesSet() {
        return [
            'id' => 'required|int',
            'name' => 'required|max:255',
        ];
    }

    public function rules($scenario = null, $type = '') {
        $rules = $this->getRules($type);

        switch ($scenario) {
//            case 'update':
//                return $this->prepareRules($rules, ['id', 'name']);
            case 'create':
                return $this->prepareRules($rules, 'name');
//            case 'delete':
//                return $this->prepareRules($rules, 'id');
            default:
                return parent::prepareRules($rules);
        }
    }
}
