<?php

namespace App\Models\Repositories;

use App\Models\Entities\Organization;

/**
 * Interface OrganizationRepository.
 *
 * @package namespace App\Models\Repositories;
 */
abstract class OrganizationRepo extends BaseRepo
{
    protected static function getRules() {
        return [
            'id' => 'required|int',
            'name' => 'required|max:255',
        ];
    }

    public static function rules($scenario = null) {
        switch ($scenario) {
//            case 'update':
//                $rules = static::prepareRules(static::getRules(), ['id', 'name']);
//                break;
            case 'create':
                $rules = static::prepareRules(static::getRules(), 'name');
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
