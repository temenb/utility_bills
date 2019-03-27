<?php

namespace App\Http\Controllers\Bill;

use App\Http\Controllers\AuthMiddlewareController as BaseController;
use App\Models\Entities\Organization;
use App\Models\Entities\Service;
use App\Models\Entities\Meter;
use App\Http\Requests\Meter\CreateExtendedRequest;
use App\Models\Repositories\OrganizationRepo;

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
        $data = $request->validated();

        if (!empty($data['organization'])) {
            $organization = Organization::create($data['organization']);
            $request->session()->flash('message.success', 'Meter was created successfully.');
            $data['organization_id'] = $organization->id;
        }
        if (!empty($data['service'])) {
            $data['service']['organization_id'] = $data['organization_id'];
            $organization = Service::create($data['service']);
            $request->session()->flash('message.success', 'Meter was created successfully.');
            $data['service_id'] = $organization->id;
        }
        if (Meter::create($data)) {
            $request->session()->flash('message.success', 'Meter was created successfully.');
        } else {
            $request->session()->flash('message.error', 'Something went wrong.');
        }
        return $this->addForm($organizationRepo);
    }

}
