<?php

namespace App\Http\Controllers\Bill;

use App\Http\Controllers\BaseMiddlewareController as BaseController;
use App\Models\Repositories\MeterRepoEloquent;
use App\Models\Repositories\MeterRepo;
use App\Models\Repositories\ServiceRepo;
use DB;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Validator;

class BoardController extends BaseController
{
    public function board(MeterRepo $meterRepo)
    {
        /** @var MeterRepoEloquent $meterRepo */
        $meters = $meterRepo->getMeterWithAllDataByUser();
        return view(
            'bill.board',
            [
                'meters' => $meters,
            ]
        );
    }
}
