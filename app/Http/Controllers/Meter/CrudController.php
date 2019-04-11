<?php

namespace App\Http\Controllers\Meter;

use App\Http\Controllers\BaseMiddlewareController as BaseController;
use App\Models\Entities\Meter;
use App\Models\Repositories\MeterRepoEloquent;
use App\Models\Repositories\ServiceRepo;
use DB;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrudController extends BaseController
{
    public function period(ServiceRepo $meterRepo, Request $request)
    {
        /** @var MeterRepoEloquent $meterRepo */
        $data = $request->validate([
            'period' => implode('|', ['required', $meterRepo->fieldRule('period')]),
            'id' => implode('|', ['sometimes', $meterRepo->fieldRule('id')]),
        ]);

        $entity = $this->updateEntity($data);
        $entity->save();

        return response()->json(['status' => 'success', 'data' => $entity->toArray()]);
    }

    public function name(ServiceRepo $meterRepo, Request $request)
    {
        /** @var MeterRepoEloquent $meterRepo */
        $data = $request->validate([
            'name' => implode('|', ['required', $meterRepo->fieldRule('name')]),
            'id' => implode('|', ['sometimes', $meterRepo->fieldRule('id')]),
        ]);

        $entity = $this->updateEntity($data);
        $entity->save();

        return response()->json(['status' => 'success', 'data' => $entity->toArray()]);
    }

    public function type(ServiceRepo $meterRepo, Request $request)
    {
        /** @var MeterRepoEloquent $meterRepo */
        $data = $request->validate([
            'type' => implode('|', ['required', $meterRepo->fieldRule('type')]),
            'id' => implode('|', ['sometimes', $meterRepo->fieldRule('id')]),
        ]);

        $entity = $this->updateEntity($data);
        $entity->save();

        return response()->json(['status' => 'success', 'data' => $entity->toArray()]);
    }

    public function rate(ServiceRepo $meterRepo, Request $request)
    {
        /** @var MeterRepoEloquent $meterRepo */
        $data = $request->validate([
            'rate' => implode('|', ['required', $meterRepo->fieldRule('rate')]),
            'id' => implode('|', ['sometimes', $meterRepo->fieldRule('id')]),
        ]);

        $entity = $this->updateEntity($data);
        $entity->save();

        return response()->json(['status' => 'success', 'data' => $entity->toArray()]);
    }

    /**
     * @param $data
     * @return Meter
     */
    protected function updateEntity($data)
    {
        if (isset($data['id'])) {
            $entity = Meter::find($data['id']);
        } else {
            $entity = new Meter;
        }
        $entity->fill($data);
        return $entity;
    }
}
