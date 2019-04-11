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
            'id' =>  'required|int|exists:meters,id',
            'name' =>  'max:255',
            'type' =>  'in:' . implode(',', Meter::enumType()),
            'period' =>  'in:' . implode(',', Meter::enumPeriod()),
            'rate' =>  'regex:/^[1-9]\\d*(\\.\\d)?\\d?$/',
        ];
    }

    protected function rulesSetSometimes() {
        $rule = resolve(ServiceRepo::class)->rule('id');
        return [
            'service_id' =>  [str_replace('required|', '', $rule), function ($input) {
                return $input->get('service_id') != static::NEW_SERVICE;
            }],
        ];
    }

    public function rules($scenario = null, $type = '') {
        $rules = $this->getRules($type);

        switch ($scenario) {
//            case 'update':
//                return $this->prepareRules($rules, ['name', 'service_id', 'type', 'rate', 'id']);
            case 'create':
                return $this->prepareRules($rules, ['name', 'service_id', 'type', 'rate']);
//            case 'delete':
//                return $this->prepareRules($rules, 'id');
            default:
                return parent::prepareRules($rules);
        }
    }
}
