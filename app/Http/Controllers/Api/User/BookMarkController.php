<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Bookmark;
use App\Services\Api\User\BookMarkService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookMarkController extends BaseController
{
    public function __construct(BookMarkService $bookMarkService)
    {
        $this->bookMarkService = $bookMarkService;
    }

    public function store(Blog $blog)
    {
        $checkBookmark = Bookmark::where([
            'user_id' => auth()->user()->id,
            'blog_id' => $blog->id
        ])->exists();

        if ($checkBookmark) {
            $result = $this->bookMarkService->destroy($blog->id);

            if ($result['code'] == Response::HTTP_OK) {
                return $this->responseSuccess([
                    'message' => 'Đã bỏ thích bài viết này'
                ]);
            }
        }

        $result = $this->bookMarkService->store($blog);

        if ($result['code'] == Response::HTTP_OK) {
            return $this->responseSuccess([
                'data' => $result['data'],
                'message' => 'Đã thích bài viết'
            ]);
        }

        return $this->responseErrors([
            'message' => 'Đã có lỗi trong quá trình thao tác'
        ]);
    }
}
