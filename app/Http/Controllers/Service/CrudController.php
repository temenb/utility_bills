<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\BaseMiddlewareController as BaseController;
use App\Models\Entities\Service;
use App\Models\Repositories\ServiceRepoEloquent;
use App\Models\Repositories\ServiceRepo;
use DB;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrudController extends BaseController
{
    public function name(ServiceRepo $serviceRepo, Request $request)
    {
        /** @var ServiceRepoEloquent $serviceRepo */
        $data = $request->validate([
            'name' => implode('|', ['required', $serviceRepo->fieldRule('name')]),
            'id' => implode('|', ['sometimes', $serviceRepo->fieldRule('id')]),
        ]);

        $entity = $this->updateEntity($data);
        $entity->save();

        return response()->json(['status' => 'success', 'data' => $entity->toArray()]);
    }

    /**
     * @param $data
     * @return Service
     */
    protected function updateEntity($data)
    {
        if (isset($data['id'])) {
            $entity = Service::find($data['id']);
        } else {
            $entity = new Service;
        }
        $entity->fill($data);
        return $entity;
    }
}
