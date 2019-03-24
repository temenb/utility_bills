<?php

namespace App\Http\Controllers\Bill;

use App\Http\Controllers\AuthMiddlewareController as BaseController;
use App\Models\Entities\Organization;
use App\Http\Requests\Organization\CreateRequest as OrganizationCreateRequest;
use App\Models\Entities\MeterValue;
use App\Events\onCreatedMeterValue;
use \App\Models\Repositories\OrganizationRepo;

class OrganizationController  extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function put(OrganizationCreateRequest $request)
    {
        $meterValue = new MeterValue(['meter_id' => 1, 'value' => 1]);
        $meterValue->save();
        event(new onCreatedMeterValue($meterValue));
        if (Organization::create($request->validated())) {
            $request->session()->flash('message.success', 'Organization was created successfully.');
        } else {
            $request->session()->flash('message.error', 'Something went wrong.');
        }
        return redirect()->back();
    }
}
