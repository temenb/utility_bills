<?php

namespace App\Http\Controllers\Bill;

use App\Http\Controllers\BaseMiddlewareController as BaseController;
use App\Models\Entities\Organization;
use App\Models\Entities\Service;
use App\Models\Entities\Meter;
use App\Http\Requests\Composed\CreateRequest as ComposedCreateRequest;
use App\Models\Repositories\MeterRepoEloquent;
use App\Models\Repositories\OrganizationRepo;
use App\Models\Repositories\MeterRepo;
use App\Models\Repositories\ServiceRepo;
use DB;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Validator;

class BoardController extends BaseController
{
    public function board(MeterRepo $meterRepo)
    {
        /** @var MeterRepoEloquent $meters */
        $meters = $meterRepo->getMeterWithAllDataByUser();
        $metersData = $meterRepo->rerangeData($meters);
        return view(
            'bill.board',
            [
                'metersData' => $metersData,
            ]
        );
    }
}
