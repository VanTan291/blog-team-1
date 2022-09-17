<?php

namespace App\Http\Requests;

class CategoryRequest extends BaseRequest
{
    public function rules()
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
