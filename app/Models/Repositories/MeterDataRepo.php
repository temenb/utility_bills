<?php

namespace App\Models\Repositories;

/**
 * Interface MeterDataRepository.
 *
 * @package namespace App\Models\Repositories;
 */
abstract class MeterDataRepo extends BaseRepo
{
//    protected function rulesSet() {
//        return [
//        'id' =>  'required|int',
//        'meter_id' =>  'required|exists:meter,id',
//        'value' =>  'required|int',
//        ];
//    }
//
//    public function rules($scenario = null, $type = '') {
//        $rules = $this->getRules($type);
//
//        switch ($scenario) {
//            case 'create':
//                return $this->prepareRules($rules, ['meter_id', 'value']);
//            case 'update':
//                return $this->prepareRules($rules, ['id', 'meter_id', 'value']);
//            case 'delete':
//                return $this->prepareRules($rules, 'id');
//            default:
//                return $this->prepareRules($rules);
//        }
//    }
}
