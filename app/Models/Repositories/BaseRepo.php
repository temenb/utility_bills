<?php

namespace App\Models\Repositories;

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

    public function fieldRule($field, $type = null) {
        $rules = $this->getRules($type);
        return isset($rules[$field]) ? $rules[$field] : '';
    }

    protected function getRules($type) {
        $getRules = 'rulesSet' . ucfirst($type);
        return method_exists($this, $getRules)? $this->{$getRules}() : [];
    }

    public function rules($scenario = null, $type = '') {
        $rules = $this->getRules($type);

        switch ($scenario) {
            default:
                return $this->prepareRules($rules);
        }
    }

    public function rule($rule, $type = '') {
        $rules = $this->getRules($type);
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
