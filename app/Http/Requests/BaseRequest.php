<?php

namespace App\Http\Requests;

use App\Models\Entities\Meter;
use App\Models\Repositories\MeterRepo;
use App\Models\Repositories\OrganizationRepo;
use App\Models\Repositories\ServiceRepo;
use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Illuminate\Support\Facades\Validator;

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
    protected function getValidatorInstance()
    {
        if ($this->validator) {
            return parent::getValidatorInstance();
        }

        parent::getValidatorInstance();

        $sometimesRules = $this->sometimesRules();
        foreach ($sometimesRules as $field => $rule) {
            $this->validator->sometimes($field, $rule[0], $rule[1]);
        }

        return $this->validator;
    }

    protected function sometimesRules()
    {
        return [];
    }

}
