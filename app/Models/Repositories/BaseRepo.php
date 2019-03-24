<?php

namespace App\Models\Repositories;

/**
 * Class MeterValueRepositoryEloquent.
 *
 * @package namespace App\Models\Repositories;
 */
abstract class BaseRepo implements RepoInterface
{
    public static function rules($scenario) {
        switch ($scenario) {
            default:
                $rules = [];
        }
        return $rules;
    }

    /**
     * @param $rules
     * @param $keys
     * @return array
     */
    protected static function prepareRules($rules, $keys) {
        $keys = (array) $keys;
        $result = [];
        foreach ($keys as $key => $val) {
            if (isset($rules[$val])) {
                $result[is_string($key)? $key : $val] = $rules[$val];
            }
        }
        return $result;
    }
}
