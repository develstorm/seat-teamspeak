<?php

namespace ZeroServer\Teamspeak\Validation;

use Illuminate\Foundation\Http\FormRequest;

class AddRelation extends FormRequest
{
    public function authorize()
    {

        return true;

    }

    public function rules()
    {
        return [
            'teamspeak-type' => 'required|string',
            'teamspeak-user-id' => 'string',
            'teamspeak-role-id' => 'string',
            'teamspeak-corporation-id' => 'string',
            'teamspeak-alliance-id' => 'string',
            'teamspeak-group-id' => 'required|string',
            'teamspeak-enabled' => 'boolean'
        ];
    }
}