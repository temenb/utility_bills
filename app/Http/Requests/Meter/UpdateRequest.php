<?php

namespace App\Http\Requests\Meter;

class UpdateRequest extends CreateRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'id' => 'required|int'
        ];
        $rules = array_merge($rules, parent::rules());
        return $rules;
    }
}
