<?php

namespace App\Http\Requests\Api;

use Illuminate\Http\Request;

class ProfileRequest extends BaseRequest
{
    public function rules(Request $request)
    {
        return [
            'name' => [
                'required',
                'max:255',
            ],
            'birthday' => [
                'required',
                'date',
            ],
            'phone' => [
                'required',
            ],
            'address' => [
                'required',
                'max:255',
            ],
        ];
    }
}
