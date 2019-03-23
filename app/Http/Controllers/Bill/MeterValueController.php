<?php

namespace App\Http\Controllers\Bill;

use App\Http\Controllers\AuthMiddlewareController as BaseController;
use App\Http\Requests\MeterValue\CreateRequest as MeterValueCreateRequest;
use App\Entities\MeterValue;

class MeterValueController  extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function put(MeterValueCreateRequest $request)
    {
        if (MeterValue::create($request->validated())) {
            $request->session()->flash('message.success', 'Value was successfully added to metter.');
        } else {
            $request->session()->flash('message.error', 'Something went wrong.');
        }
        return redirect()->back();
    }
}
