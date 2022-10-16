<?php

namespace App\Services\Api\User;

use App\Models\Favorite;
use App\Services\BaseService;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class FavoriteService extends BaseService
{
    public function __construct(Favorite $model)
    {
        $this->model = $model;
    }

    public function addFavoriteBlog($blogId)
    {
        try {
            $addFavorite = $this->model->firstOrCreate([
                'user_id' => Auth::user()->id,
                'favoriteable_id' => $blogId,
                'favoriteable_type' => 'blog',
            ]);

            if ($addFavorite) {
                return [
                    'code' => Response::HTTP_OK,
                    'message' => 'Đã thêm vào danh sách ưa thích thành công',
                ];
            }
        } catch (Exception $e) {
            return [
                'code' => Response::HTTP_FORBIDDEN,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function deleteFavoriteBlog($blogId)
    {
        try {
            $addFavorite = $this->model->where('user_id',  Auth::user()->id)
                ->where('favoriteable_id', $blogId)
                ->where('favoriteable_type', 'blog')->delete();

            if ($addFavorite) {
                return [
                    'code' => Response::HTTP_OK,
                    'message' => 'Đã xóa khỏi danh sách ưa thích thành công',
                ];
            }

            return [
                'code' => Response::HTTP_FORBIDDEN,
                'message' => 'Không thấy blog trong danh sách ưa thích',
            ];
        } catch (Exception $e) {
            return [
                'code' => Response::HTTP_FORBIDDEN,
                'message' => $e->getMessage(),
            ];
        }
    }
}
