<?php

namespace App\Services\Api;

use App\Models\Category;
use App\Models\Tag;
use App\Services\BaseService;
use Exception;
use Illuminate\Http\Response;

class TagService extends BaseService
{
    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        try {
            $categories = $this->model->latest('id');

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

    public function update($params, $tag)
    {
        try {
            $tag->update($params);

            if ($tag) {
                return [
                    'status' => Response::HTTP_OK,
                    'data' => $tag,
                ];
            }
        } catch (Exception $e) {
            return [
                'status' => Response::HTTP_FORBIDDEN,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function destroy($tag)
    {
        try {
            $tag->delete();

            if ($tag) {
                return [
                    'status' => Response::HTTP_OK,
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
