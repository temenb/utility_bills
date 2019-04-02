<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Validation\Validator;

class AuthMiddlewareController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Validator $validator
     * @param $sometimesRules
     */
    protected function addSometimesRules(Validator $validator, $sometimesRules)
    {
        if ($sometimesRules && is_array($sometimesRules)) {
            foreach ($sometimesRules as $key => $rule) {
                $validator->sometimes($key, $rule[0], $rule[1]);
            }
        }
    }
}
