<?php

namespace App\Http\Controllers\Bill;

use App\Http\Controllers\AuthMiddlewareController as BaseController;
use App\Models\Entities\Organization;
use App\Models\Entities\Service;
use App\Models\Entities\Meter;
use App\Http\Requests\Composed\CreateRequest as ComposedCreateRequest;
use App\Models\Repositories\OrganizationRepo;
use App\Models\Repositories\MeterRepo;
use App\Models\Repositories\ServiceRepo;
use DB;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Validator;

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

    public function board(MeterRepo $meterRepo)
    {
        $meters = $meterRepo->getMeterWithAllDataByUser();
        $metersData = $meterRepo->rerangeData($meters);
        return view(
            'bill.board',
            [
                'metersData' => $metersData,
            ]
        );
    }

    public function putForm(ComposedCreateRequest $request, OrganizationRepo $organizationRepo)
    {
        DB::transaction(function () use ($request) {
            $data = $request->validated();
            $errors = [];

            if (!empty($data['organization'])) {
                $organizationRepo = resolve(OrganizationRepo::class);
                $organizationValidator = Validator::make($data['organization'], $organizationRepo->rules('create'));
                $this->addSometimesRules($organizationValidator, $organizationRepo->rules('create', 'sometimes'));

                if ($organizationValidator->passes()) {

                    $organization = Organization::create($data['organization']);
                    if ($organization) {
                        $request->session()->flash('message.success', 'Organization was created successfully.');
                        $data['organization_id'] = $organization->id;
                    } else {
                        $errors[] = 'Organization was not created.';
                    }
                }
            }
            if (!empty($data['service'])) {
                $serviceRepo = resolve(ServiceRepo::class);
                $serviceValidator = Validator::make($data['service'], $serviceRepo->rules('create'));
                $this->addSometimesRules($serviceValidator, $serviceRepo->rules('create', 'sometimes'));

                if ($serviceValidator->passes()) {
                    if (!empty($data['organization_id'])) {
                        $data['service']['organization_id'] = $data['organization_id'];
                    }
                    $service = Service::create($data['service']);
                    if ($service) {
                        $request->session()->flash('message.success', 'Meter was created successfully.');
                        $data['service_id'] = $service->id;
                    } else {
                        $errors[] = 'Service was not created.';
                    }
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
