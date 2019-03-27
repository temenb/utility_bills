<?php

namespace App\Http\Controllers\Bill;

use App\Http\Controllers\AuthMiddlewareController as BaseController;
use App\Models\Entities\Organization;
use App\Models\Entities\Service;
use App\Models\Entities\Meter;
use App\Http\Requests\Meter\CreateExtendedRequest;
use App\Models\Repositories\OrganizationRepo;
use DB;
use http\Exception\InvalidArgumentException;

class BoardController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function addForm(OrganizationRepo $organizationRepo)
    {
        $organizations = $organizationRepo->getUserRelatedOrganizations();
        $services = Service::all();
        return view('bill.add', [
            'organizations' => $organizations,
            'services' => $services,
        ]);
    }

    public function board(OrganizationRepo $organizationRepo)
    {
        $organizations = $organizationRepo->getUserRelatedOrganizations();
        $organizationRowspan = $organizationRepo->calculateOrganizationRowspan($organizations);
        return view(
            'bill.board',
            [
                'organizations' => $organizations,
                'organizationRowspan' => $organizationRowspan
            ]
        );
    }

    public function putForm(CreateExtendedRequest $request, OrganizationRepo $organizationRepo)
    {

        DB::transaction(function () use ($request) {
            $data = $request->validated();
            $errors = [];
            if (!empty($data['organization'])) {
                $organization = Organization::create($data['organization']);
                if ($organization) {
                    $request->session()->flash('message.success', 'Meter was created successfully.');
                    $data['organization_id'] = $organization->id;
                } else {
                    $errors[] = 'Organization was not created.';
                }
            }
            if (!empty($data['service'])) {
                $data['service']['organization_id'] = $data['organization_id'];
                $service = Service::create($data['service']);
                if ($service) {
                    $request->session()->flash('message.success', 'Meter was created successfully.');
                    $data['service_id'] = $service->id;
                } else {
                    $errors[] = 'Service was not created.';
                }
            }
            if (Meter::create($data)) {
                $request->session()->flash('message.success', 'Meter was created successfully.');
            } else {
                $errors[] = 'Meter was not created.';
            }

            if ($errors) {
                throw new \Exception(serialize($errors));
            }
        });
        return $this->addForm($organizationRepo);
    }

}
