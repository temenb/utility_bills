<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

abstract class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validator instance for the request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
//    protected function getValidatorInstance()
//    {
//        if ($this->validator) {
//            return parent::getValidatorInstance();
//        }
//
//        parent::getValidatorInstance();
//
//        $sometimesRules = $this->sometimesRules();
//        foreach ($sometimesRules as $field => $rule) {
//            $this->validator->sometimes($field, $rule[0], $rule[1]);
//        }
//
//        return $this->validator;
//    }
//
//    protected function sometimesRules()
//    {
//        return [];
//    }

}
