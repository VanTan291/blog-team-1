<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Validation\Rule;
use App\Http\Requests\Api\BaseRequest;

class BlogRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'series' => [
            //     'required',
            //     'string',
            // ],
            'category' => [
                'required',
                'string',
            ],
            'tags' => [
                function ($attribute, $value, $fail) {
                    $tags = json_decode($value);

                    if (count($tags) < 1) {
                        $fail('Trường Tag không được bỏ trống');
                    }
                },
                'string',
            ],
            'title' => [
                'required',
                'string',
            ],
            'description' => [
                'required',
                'string',
            ],
            'content' => [
                'required',
            ],
            'thumbnail' => [
                'required',
                'image'
            ],
        ];
    }
}
