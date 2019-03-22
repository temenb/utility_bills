<?php

namespace App\Http\Controllers\Bill;

use App\Http\Controllers\AuthMiddlewareController as BaseController;
use App\Entities\Organization;
use App\Entities\Service;

class BoardController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function createForm()
    {
        $organizations = Organization::all();
        $services = Service::all();
        return view('bill.add', [
            'organizations' => $organizations,
            'services' => $services,
        ]);
    }

    public function board()
    {
        $organizations = Organization::with('services', 'services.meters', 'accounts')->get();
        $organizationRowspan = $this->calculateOrganizationRowspan($organizations);
        return view(
            'bill.board',
            [
                'organizations' => $organizations,
                'organizationRowspan' => $organizationRowspan
            ]
        );
    }

    /**
     * @param $organizations
     * @return array
     */
    private function calculateOrganizationRowspan($organizations): array
    {
        $organizationRowspan = [];
        foreach ($organizations as $organization) {
            $organizationRowspan[$organization->id] = 1;
            if (count($organization->services)) {
                $organizationRowspan[$organization->id] = 0;
                foreach ($organization->services as $service) {
                    $metersCount = count($service->meters);
                    $organizationRowspan[$organization->id] += $metersCount ?? 1;
                }
            }
        }
        return $organizationRowspan;
    }
}
