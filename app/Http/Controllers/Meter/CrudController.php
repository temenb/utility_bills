<?php

namespace App\Http\Controllers\Meter;

use App\Http\Controllers\BaseMiddlewareController as BaseController;
use App\Models\Entities\Meter;
use App\Models\Repositories\MeterRepoEloquent;
use App\Models\Repositories\MeterRepo;
use App\Models\Repositories\ServiceRepo;
use DB;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\Request;

class CrudController extends BaseController
{
    public function update(MeterRepo $meterRepo, ServiceRepo $serviceRepo, Request $request)
    {
        /** @var MeterRepoEloquent $meterRepo */
        $data = $request->validate([
            'name' => implode('|', ['sometimes', 'required', $meterRepo->fieldRule('name')]),
            'type' => implode('|', ['sometimes', 'required', $meterRepo->fieldRule('type')]),
            'rate' => implode('|', ['sometimes', 'required', $meterRepo->fieldRule('rate')]),
            'period' => implode('|', ['sometimes', 'required', $meterRepo->fieldRule('period')]),
            'id' => implode('|', ['sometimes', $meterRepo->fieldRule('id')]),
            'service_id' => implode('|', ['sometimes', $serviceRepo->fieldRule('service_id')]),
        ]);

        if (isset($data['id'])) {
            $entity = Meter::find($data['id']);
        } else {
            $entity = new Meter;
        }
        $entity->fill($data);
        $entity->save();
        return response()->json(['status' => 'success', 'data' => $entity->toArray()]);
    }
}
