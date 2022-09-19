<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\Api\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends BaseController
{
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $result = $this->categoryService->index();

        if ($result['status'] == Response::HTTP_OK) {
            return $this->responseSuccess([
                'data' => CategoryResource::apiPaginate($result['data'], $request),
                'code' => Response::HTTP_OK
            ]);
        }

        return $this->responseErrors($result['message']);
    }

    public function store(CategoryRequest $request)
    {
        $result = $this->categoryService->store($request->validated());

        if ($result['status'] == Response::HTTP_CREATED) {
            return $this->responseSuccess([
                'code' => Response::HTTP_OK
            ]);
        }

        return $this->responseErrors($result['message']);
    }

    public function show(Category $category)
    {
        if ($category) {
            return $this->responseSuccess([
                'data' => new CategoryResource($category),
                'code' => Response::HTTP_OK
            ]);
        }
       
        return $this->responseErrors('Category not found');
    }

    public function update(Category $category, CategoryRequest $request)
    {
        $result = $this->categoryService->update($request->validated(), $category);

        if ($result['status'] == Response::HTTP_OK) {
            return $this->responseSuccess([
                'data' => new CategoryResource($category),
                'code' => Response::HTTP_OK
            ]);
        }

        return $this->responseErrors($result['message']);
    }

    public function destroy(Category $category)
    {
        $result = $this->categoryService->destroy($category);

        if ($result['status'] == Response::HTTP_OK) {
            return $this->responseSuccess([
                'code' => Response::HTTP_OK
            ]);
        }

        return $this->responseErrors($result['message']);
    }
}
