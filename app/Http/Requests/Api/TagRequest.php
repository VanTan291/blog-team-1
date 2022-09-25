<?php

namespace App\Http\Requests;

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
