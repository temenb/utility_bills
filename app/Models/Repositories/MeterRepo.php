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
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Meter::class;
    }

    public static function rules($scenario) {
        $_rules = [
            'id' => 'required|int',
            'name' => 'required|max:255',
            'service_id' => 'required|exists:service,id',
        ];

        $rules = [];
        switch ($scenario) {
            case 'update':
                $rules = self::prepareRules($_rules, ['id', 'name', 'service_id']);
            case 'create':
                $rules = self::prepareRules($_rules, ['name', 'service_id']);
                break;
            case 'delete':
                $rules = self::prepareRules($_rules, 'id');
                break;
            default:
        }
        return $rules;
    }
}
