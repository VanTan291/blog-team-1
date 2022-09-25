<?php

namespace App\Http\Requests\Api;

use Illuminate\Http\Request;

class TagRequest extends BaseRequest
{
    public function rules(Request $request)
    {
        return [
            'name' => [
                'required',
                'max:255',
            ],
            'status' => [
                'required'
            ],
        ];
    }
}
