<?php

namespace App\Http\Controllers;

class AuthMiddlewareController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
