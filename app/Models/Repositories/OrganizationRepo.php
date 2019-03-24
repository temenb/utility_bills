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
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Organization::class;
    }

    public static function rules($scenario) {
        $_rules = [
            'id' => 'required|int',
            'name' => 'required|max:255',
        ];

        $rules = [];
        switch ($scenario) {
            case 'update':
                $rules = self::prepareRules($_rules, ['id', 'name']);
                break;
            case 'create':
                $rules = self::prepareRules($_rules, 'name');
                break;
            case 'delete':
                $rules = self::prepareRules($_rules, 'id');
                break;
            default:
        }
        return $rules;
    }
}
