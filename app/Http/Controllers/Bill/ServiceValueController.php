<?php

namespace App\Http\Controllers\Bill;

use App\Http\Controllers\AuthMiddlewareController as BaseController;
use App\Http\Requests\ServiceValue\CreateRequest as ServiceValueCreateRequest;
use App\Models\Entities\ServiceValue;

class ServiceValueController  extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function put(ServiceValueCreateRequest $request)
    {
        if (ServiceValue::create($request->validated())) {
            $request->session()->flash('message.success', 'Value was successfully added to Service.');
        } else {
            $request->session()->flash('message.error', 'Something went wrong.');
        }
        return redirect()->back();
    }
}
