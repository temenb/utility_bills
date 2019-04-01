<?php

namespace App\Models\Repositories;

use App\Models\Entities\MeterData;

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
//        $rules = static::getRules($type);
//
//        switch ($scenario) {
//            case 'create':
//                $_rules = static::prepareRules($rules, ['meter_id', 'value']);
//                break;
//            case 'update':
//                $_rules = static::prepareRules($rules, ['id', 'meter_id', 'value']);
//                break;
//            case 'delete':
//                $_rules = static::prepareRules($rules, 'id');
//            break;
//            default:
//                $_rules = static::prepareRules($rules);
//        }
//        return $_rules;
//    }
}
