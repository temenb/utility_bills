<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\BaseMiddlewareController as BaseController;
use App\Models\Entities\Meter;
use App\Models\Entities\Service;
use App\Models\Repositories\MeterRepo;
use App\Models\Repositories\ServiceRepoEloquent;
use App\Models\Repositories\ServiceRepo;
use DB;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrudController extends BaseController
{
    public function update(ServiceRepo $serviceRepo, MeterRepo $meterRepo, Request $request)
    {
        /** @var ServiceRepoEloquent $serviceRepo */
        $data = $request->validate([
            'name' => implode('|', ['sometimes', 'required', $serviceRepo->fieldRule('name')]),
            'meter_id' => $meterRepo->fieldRule('id'),
            'id' => implode('|', ['sometimes', $serviceRepo->fieldRule('id')]),
        ]);

        if (isset($data['id'])) {
            $entity = Service::find($data['id']);
        } else {
            $entity = new Service;
        }

        $meter = Meter::find($data['meter_id']);
        $entity->fill($data);
        DB::transaction(function() use ($entity, $meter) {
            $entity->save();
            $meter->service()->associate($entity);
            $meter->save();
        });
        return response()->json(['status' => 'success', 'data' => $entity->toArray()]);
    }
}
