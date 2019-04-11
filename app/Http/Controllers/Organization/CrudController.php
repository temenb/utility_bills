<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\BaseMiddlewareController as BaseController;
use App\Models\Entities\Organization;
use App\Models\Repositories\OrganizationRepo;
use App\Models\Repositories\OrganizationRepoEloquent;
use DB;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrudController extends BaseController
{

    public function name(OrganizationRepo $organizationRepo, Request $request)
    {
        /** @var OrganizationRepoEloquent $organizationRepo */
        $data = $request->validate([
            'name' => implode('|', ['required', $organizationRepo->fieldRule('name')]),
            'id' => implode('|', ['sometimes', $organizationRepo->fieldRule('id')]),
        ]);

        $entity = $this->updateEntity($data);
        $entity->save();

        return response()->json(['status' => 'success', 'data' => $entity->toArray()]);
    }

    /**
     * @param $data
     * @return Organization
     */
    protected function updateEntity($data)
    {
        if (isset($data['id'])) {
            $entity = Organization::find($data['id']);
        } else {
            $entity = new Organization;
        }
        $entity->fill($data);
        return $entity;
    }
}
