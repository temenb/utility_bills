<?php

namespace App\Http\Requests\Composed;

use App\Http\Requests\BaseRequest;
use App\Models\Repositories\MeterRepo;
use App\Models\Repositories\OrganizationRepo;
use App\Models\Repositories\ServiceRepo;
use Auth;

class CreateRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $serviceRules = resolve(ServiceRepo::class)->rules('create');
        $organizationRules = resolve(OrganizationRepo::class)->rules('create');
        $rules = resolve(MeterRepo::class)->rules('create');
        $rules['service.name'] = str_replace('required|', '', $serviceRules['name']);
        $rules['organization.name'] = str_replace('required|', '', $organizationRules['name']);
        return $rules;
    }

    protected function sometimesRules()
    {
        $meterRules = resolve(MeterRepo::class)->rules('create', 'sometimes');
        $serviceRules = resolve(ServiceRepo::class)->rules('create', 'sometimes');
        return array_merge($serviceRules, $meterRules);
    }

}
