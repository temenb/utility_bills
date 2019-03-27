<?php

namespace App\Http\Requests\Meter;

use App\Models\Repositories\MeterRepo;
use App\Models\Repositories\OrganizationRepo;
use App\Models\Repositories\ServiceRepo;
use Illuminate\Foundation\Http\FormRequest;
use Auth;

class CreateExtendedRequest extends FormRequest
{
    const NEW_ORGANIZATION = 'new';
    const NEW_SERVICE = 'new';

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
        $rules = MeterRepo::rules('create');
        foreach(OrganizationRepo::rules('create') as $index => $rule) {
            $rules["organization.{$index}"] = $rule;
        }
        foreach(ServiceRepo::rules('create') as $index => $rule) {
            $rules["service.{$index}"] = $rule;
        }
        unset($rules['service.organization_id']);

        $rules = $this->removeNewOrExistedRule($rules, 'organization_id', self::NEW_ORGANIZATION, 'organization.name');
        $rules = $this->removeNewOrExistedRule($rules, 'service_id', self::NEW_SERVICE, 'service.name');

        return $rules;
    }

    /**
     * @param array $rules
     * @param $existedField
     * @param $newFlag
     * @param $newField
     * @return array
     */
    private function removeNewOrExistedRule(array $rules, $existedField, $newFlag, $newField)
    {
        if ($this->get($existedField) == $newFlag) {
            unset($rules[$existedField]);
        } else {
            $rules[$newField] = 'nullable|not_regex:/./';
        }
        return $rules;
    }
}
