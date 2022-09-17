<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Services\Api\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $result = $this->categoryService->index();

        if ($result['status'] == Response::HTTP_OK) {
            return response()->json([
                'data' => new CategoryResource($result['data']),
                'code' => Response::HTTP_OK
            ]);
        }

        return $this->responseErrors($result['message']);
    }
}
