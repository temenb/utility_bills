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
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Service::class;
    }

    public static function rules($scenario) {
        $_rules = [
            'id' => 'required|int',
            'name' => 'required|max:255',
            'organization_id' => 'required|exists:organizations,id',
        ];

        $rules = [];
        switch ($scenario) {
            case 'update':
                $rules = self::prepareRules($_rules, ['id', 'name', 'organization_id']);
            case 'create':
                $rules = self::prepareRules($_rules, ['name', 'organization_id']);
                break;
            case 'delete':
                $rules = self::prepareRules($_rules, 'id');
                break;
            default:
        }
        return $rules;
    }
}
