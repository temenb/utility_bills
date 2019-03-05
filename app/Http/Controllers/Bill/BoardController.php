<?php

namespace App\Http\Controllers\Bill;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Organization;

class BoardController extends Controller
{
    public function board()
    {
        $organizations = Organization::with('services', 'services.meters', 'accounts')->get();
        return view('bill.board', ['organizations' => $organizations]);
    }
}
