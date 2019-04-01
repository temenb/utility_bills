<?php

namespace App\Http\Requests\Meter;

use App\Models\Entities\Meter;
use App\Models\Repositories\MeterRepo;
use App\Models\Repositories\OrganizationRepo;
use App\Models\Repositories\ServiceRepo;
use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Illuminate\Support\Facades\Validator;

class CreateRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return resolve(MeterRepo::class)->rules('create');
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

        $rules = resolve(MeterRepo::class)->rules('create', 'sometimes');
        foreach ($rules as $field => $rule) {
            $this->validator->sometimes($field, $rule[0], $rule[1]);
        }

        return $this->validator;
    }

}
