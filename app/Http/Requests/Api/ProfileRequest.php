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
            'gender' => [
                'required',
            ],
            'address' => [
                'required',
                'max:255',
            ],
            'city' => [
                'required',
            ],
            'district' => [
                'required',
            ],
            'wards' => [
                'required',
            ],
            'education' => [
                'required',
            ],
            'avatar' => [
                'required',
                'image',
            ]
        ];
    }
}
