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
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MeterValue::class;
    }

    public static function rules($scenario) {
        $_rules = [
            'id' => 'required|int',
            'meter_id' => 'required|exists:meter,id',
            'value' => 'required|int',
        ];

        $rules = [];
        switch ($scenario) {
            case 'create':
                $rules = self::prepareRules($_rules, ['meter_id', 'value']);
                break;
            case 'update':
                $rules = self::prepareRules($_rules, ['id', 'meter_id', 'value']);
                break;
            case 'delete':
                $rules = self::prepareRules($_rules, 'id');
            break;
            default:
        }
        return $rules;
    }
}
