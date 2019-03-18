<?php

namespace App\Http\Controllers\Bill;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Entities\Organization;

class BoardController extends Controller
{

    public function __construct()
    {
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
