<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class RegistryRequest extends FormRequest
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
            'password' => "required|in:1234567890.",
            'when' => [
                "required",
                "date_format:d/m/y H:i"
            ],
            'O3' => 'required',
            'NO' => 'required',
            'NO2' => 'required',
            'NOx' => 'required',
            'CO' => 'required',
            'SO2' => 'required',
            'PM25' => 'required'
        ];
    }


}
