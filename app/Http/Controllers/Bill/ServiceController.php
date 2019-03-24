<?php

namespace App\Http\Controllers\Bill;

use App\Http\Controllers\AuthMiddlewareController as BaseController;
use App\Http\Requests\Service\CreateRequest as ServiceCreateRequest;
use App\Models\Entities\Service;

class ServiceController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function put(ServiceCreateRequest $request)
    {
        if (Service::create($request->validated())) {
            $request->session()->flash('message.success', 'Service was created successfully.');
        } else {
            $request->session()->flash('message.error', 'Something went wrong.');
        }
        return redirect()->back();
    }
}
