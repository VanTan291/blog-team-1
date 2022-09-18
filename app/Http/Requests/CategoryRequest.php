<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

class CategoryRequest extends BaseRequest
{
    public function rules(Request $request)
    {dd($request->all());
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
