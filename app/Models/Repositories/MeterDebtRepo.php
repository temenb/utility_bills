<?php

namespace App\Models\Repositories;

use App\Models\Entities\MeterDebt;

/**
 * Interface AccountRepository.
 *
 * @package namespace App\Models\Repositories;
 */
abstract class MeterDebtRepo extends BaseRepo
{
//    protected function rulesSet() {
//        return [
//            'id' => 'required|int',
//            'name' => 'required|max:255',
//        ];
//    }
//
//    public function rules($scenario = null, $type = '') {
//        $rules = static::getRules($type);
//
//        switch ($scenario) {
//            case 'update':
//                $_rules = static::prepareRules($rules, ['id', 'name']);
//                break;
//            case 'create':
//                $_rules = static::prepareRules($rules, 'name');
//                break;
//            case 'delete':
//                $_rules = static::prepareRules($rules, 'id');
//                break;
//            default:
//                $_rules = static::prepareRules($rules);
//        }
//        return $_rules;
//    }
}
