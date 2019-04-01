<?php

namespace App\Models\Repositories;

use phpDocumentor\Reflection\Types\Static_;

/**
 * Class MeterDataRepositoryEloquent.
 *
 * @package namespace App\Models\Repositories;
 */
abstract class BaseRepo implements RepoInterface
{
    protected function rulesSet() {
        return [];
    }

    protected function getRules($type) {
        $getRules = 'rulesSet' . ucfirst($type);
        return method_exists($this, $getRules)? $this->{$getRules}() : [];
    }

    public function rules($scenario = null, $type = '') {
        $rules = static::getRules($type);

        switch ($scenario) {
            default:
                $_rules = static::prepareRules($rules);
        }
        return $_rules;
    }

    public function rule($rule) {
        $rules = static::rulesSet();
        return isset($rules[$rule]) ? $rules[$rule] : '';
    }

    /**
     * @param $rules
     * @param $keys
     * @return array
     */
    protected function prepareRules($rules, $keys = null) {
        if (is_null($keys)) {
            return $rules;
        }
        $keys = array_flip((array) $keys);
        return array_intersect_key($rules, $keys);
    }
}
