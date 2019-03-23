<?php

namespace App\Http\Requests\Meter;

use App\Entities\Meter;
use Illuminate\Foundation\Http\FormRequest;
use Auth;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'service_id' => 'required|exists:services,id',
        ];
    }
}
