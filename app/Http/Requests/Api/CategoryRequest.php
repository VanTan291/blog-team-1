<?php

namespace App\Http\Requests\Api;

use Illuminate\Http\Request;

class CategoryRequest extends BaseRequest
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
