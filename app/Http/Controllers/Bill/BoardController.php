<?php

namespace App\Http\Controllers\Bill;

use App\Http\Controllers\AuthMiddlewareController as BaseController;
use App\Models\Entities\Organization;
use App\Models\Entities\Service;
use App\Models\Repositories\OrganizationRepo;

class BoardController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function createForm(OrganizationRepo $organizationRepo)
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
}
