<?php

namespace App\Services\Api;

use App\Models\Category;
use App\Services\BaseService;
use Exception;
use Illuminate\Http\Response;

class CategoryService extends BaseService
{
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        try {
            $categories = $this->model;

            if ($categories) {
                return [
                    'status' => Response::HTTP_OK,
                    'data' => $categories,
                ];
            }
        } catch (Exception $e) {
            return [
                'status' => Response::HTTP_FORBIDDEN,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function store($params)
    {
        try {
            $category = $this->model->create($params);

            if ($category) {
                return [
                    'status' => Response::HTTP_CREATED,
                    'data' => $category,
                ];
            }
        } catch (Exception $e) {
            return [
                'status' => Response::HTTP_FORBIDDEN,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function update($params, $category)
    {
        try {
            $category->update($params);

            if ($category) {
                return [
                    'status' => Response::HTTP_OK,
                    'data' => $category,
                ];
            }
        } catch (Exception $e) {
            return [
                'status' => Response::HTTP_FORBIDDEN,
                'message' => $e->getMessage(),
            ];
        }
    }
}
