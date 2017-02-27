<?php

namespace ZeroServer\Teamspeak\Validation;

use Illuminate\Foundation\Http\FormRequest;
use Seat\Services\Settings\Seat;

class ValidateGroup extends FormRequest
{
    public function authorize()
    {

        return true;

    }

    public function rules()
    {
        return [
            'defaults-1' => 'required|integer',
            'defaults-2' => 'required|integer',
            'defaults-3' => 'required|integer',
            'defaults-4' => 'required|integer',
            'defaults-5' => 'required|integer'
        ];
    }
}