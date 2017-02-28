<?php

namespace ZeroServer\Teamspeak\Validation;

use Illuminate\Foundation\Http\FormRequest;
use Seat\Services\Settings\Seat;

class ValidateConfiguration extends FormRequest
{
    public function authorize()
    {

        return true;

    }

    public function rules()
    {
        return [
            'teamspeak_username' => 'required|string',
            'teamspeak_password' => 'required|string',
            'teamspeak_hostname' => 'required|string',
            'teamspeak_query' => 'required|integer',
            'teamspeak_port' => 'required|integer'
        ];
    }
}