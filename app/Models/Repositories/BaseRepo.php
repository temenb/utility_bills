<?php

namespace App\Models\Repositories;

/**
 * Class MeterValueRepositoryEloquent.
 *
 * @package namespace App\Models\Repositories;
 */
abstract class BaseRepo implements RepoInterface
{
    protected static function getRules() {
        return [];
    }

    public static function rules($scenario = null) {
        switch ($scenario) {
            default:
                $rules = static::prepareRules(static::getRules());
        }
        return $rules;
    }

    public static function rule($rule) {
        $rules = static::getRules();
        return isset($rules[$rule]) ? $rules[$rule] : '';
    }

    /**
     * @param $rules
     * @param $keys
     * @return array
     */
    protected static function prepareRules($rules, $keys = null) {
        if (is_null($keys)) {
            return $rules;
        }
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