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
            $categories = $this->model->all();

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
}
