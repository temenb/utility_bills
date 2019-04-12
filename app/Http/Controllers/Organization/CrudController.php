<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\BaseMiddlewareController as BaseController;
use App\Models\Entities\Organization;
use App\Models\Entities\Service;
use App\Models\Repositories\OrganizationRepo;
use App\Models\Repositories\OrganizationRepoEloquent;
use App\Models\Repositories\ServiceRepo;
use DB;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\Request;

class CrudController extends BaseController
{

    public function update(OrganizationRepo $organizationRepo, ServiceRepo $serviceRepo, Request $request)
    {
        /** @var OrganizationRepoEloquent $organizationRepo */
        $data = $request->validate([
            'name' => implode('|', ['sometimes', 'required', $organizationRepo->fieldRule('name')]),
            'service_id' => $serviceRepo->fieldRule('id'),
            'id' => implode('|', ['sometimes', $organizationRepo->fieldRule('id')]),
        ]);

        if (isset($data['id'])) {
            $entity = Organization::find($data['id']);
        } else {
            $entity = new Organization;
        }

        $service = Service::find($data['service_id']);
        $entity->fill($data);
        DB::transaction(function() use ($entity, $service) {
            $entity->save();
            $service->organization()->associate($entity);
            $service->save();
        });
        $entity->save();
        return response()->json(['status' => 'success', 'data' => $entity->toArray()]);
    }
}
