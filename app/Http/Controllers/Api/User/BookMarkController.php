<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookMarkController extends BaseController
{
    public function __construct()
    {
        
    }

    public function get()
    {

    }

    public function store(Blog $blog)
    {
        $result = $this->BookMarksService->store($blog);

        if ($result['code'] == Response::HTTP_OK) {
            return $this->responseSuccess([
                'data' => $result['data']
            ]);
        }
        
        return $this->responseErrors([
            'message' => 'Đã có lỗi trong quá trình thao tác'
        ]);
    }
}
