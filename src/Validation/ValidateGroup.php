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
            'corp-template' => 'required|integer',
        ];
    }
}