<?php

namespace App\Http\Requests\MeterValue;

use App\Models\Repositories\MeterValueRepo;
use Illuminate\Foundation\Http\FormRequest;
use Auth;


class UpdateRequest extends FormRequest
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
        return MeterValueRepo::rules('update');
    }
}
