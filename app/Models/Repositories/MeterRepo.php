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
    const NEW_SERVICE = 'new';

    protected function rulesSet() {
        return [
            'id' =>  'required|int',
            'name' =>  'required|max:255',
            'type' =>  'required|in:' . implode(',', Meter::enumType()),
            'rate' =>  'required|regex:/^[1-9]\\d*(\\.\\d)?\\d?$/',
        ];
    }

    protected function rulesSetSometimes() {
        $rules = [
            'service_id' =>  ['sometimes|exists:services,id', function ($input) {
                return $input->get('service_id') != static::NEW_SERVICE;
            }],
        ];

        $serviceRules = resolve(ServiceRepo::class)->rules('create', 'sometimes');
        return array_merge($rules, $serviceRules);
    }

    public function rules($scenario = null, $type = '') {
        $rules = static::getRules($type);

        switch ($scenario) {
//            case 'update':
//                $_rules = static::prepareRules($rules, ['name', 'service_id', 'type', 'rate', 'id']);
//                break;
            case 'create':
                $_rules = static::prepareRules($rules, ['name', 'service_id', 'type', 'rate']);
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
