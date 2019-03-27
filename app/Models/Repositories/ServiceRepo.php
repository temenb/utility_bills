<?php

namespace App\Models\Repositories;

use App\Models\Entities\Service;

/**
 * Interface ServiceRepository.
 *
 * @package namespace App\Models\Repositories;
 */
abstract class ServiceRepo extends BaseRepo
{
    protected static function getRules() {
        return [
            'id' => 'required|int',
            'name' => 'required|max:255',
            'organization_id' => 'required|exists:organizations,id',
        ];
    }

    public static function rules($scenario = null) {
        switch ($scenario) {
//            case 'update':
//                $rules = static::prepareRules(static::getRules(), ['id', 'name', 'organization_id']);
//                break;
            case 'create':
                $rules = static::prepareRules(static::getRules(), ['name', 'organization_id']);
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
