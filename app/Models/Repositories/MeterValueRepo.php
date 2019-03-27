<?php

namespace App\Models\Repositories;

use App\Models\Entities\MeterValue;

/**
 * Interface MeterValueRepository.
 *
 * @package namespace App\Models\Repositories;
 */
abstract class MeterValueRepo extends BaseRepo
{
    protected static function getRules() {
        return [
        'id' =>  'required|int',
        'meter_id' =>  'required|exists:meter,id',
        'value' =>  'required|int',
        ];
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MeterValue::class;
    }

    public static function rules($scenario = null) {
        switch ($scenario) {
            case 'create':
                $rules = static::prepareRules(static::getRules(), ['meter_id', 'value']);
                break;
            case 'update':
                $rules = static::prepareRules(static::getRules(), ['id', 'meter_id', 'value']);
                break;
            case 'delete':
                $rules = static::prepareRules(static::getRules(), 'id');
            break;
            default:
                $rules = static::prepareRules(static::getRules());
        }
        return $rules;
    }
}
