<?php

namespace App\Models\Repositories;

use App\Models\Entities\Meter;

/**
 * Interface MeterRepository.
 *
 * @package namespace App\Models\Repositories;
 */
abstract class MeterRepo extends BaseRepo
{
    protected static function getRules() {
        return [
            'id' =>  'required|int',
            'name' =>  'required|max:255',
            'service_id' =>  'required|exists:services,id',
            'type' =>  'required|in:' . implode(',', Meter::enumType()),
            'rate' =>  'required|regex:/^[1-9]\\d*(\\.\\d)?\\d?$/',
        ];
    }

    public static function rules($scenario = null) {

        switch ($scenario) {
//            case 'update':
//                $rules = static::prepareRules(static::getRules(), ['name', 'service_id', 'type', 'rate', 'id']);
//                break;
            case 'create':
                $rules = static::prepareRules(static::getRules(), ['name', 'service_id', 'type', 'rate']);
                break;
//            case 'delete':
//                $rules = static::prepareRules(static::getRules(), 'id');
//                break;
            default:
                $rules = static::prepareRules(static::getRules());
        }
        return $rules;
    }
}
