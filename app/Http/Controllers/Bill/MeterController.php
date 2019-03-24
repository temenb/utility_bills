<?php

namespace App\Http\Controllers\Bill;

use App\Http\Controllers\AuthMiddlewareController as BaseController;
use App\Http\Requests\Meter\CreateRequest as MeterCreateRequest;
use App\Models\Entities\Meter;

class MeterController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function put(MeterCreateRequest $request)
    {
        if (Meter::create($request->validated())) {
            $request->session()->flash('message.success', 'Meter was created successfully.');
        } else {
            $request->session()->flash('message.error', 'Something went wrong.');
        }
        return redirect()->back();
    }
}
