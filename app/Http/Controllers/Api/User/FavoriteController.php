<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Favorite;
use App\Services\Api\User\FavoriteService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FavoriteController extends Controller
{
    protected $favoriteService;

    public function __construct(FavoriteService $favoriteService)
    {
        $this->favoriteService = $favoriteService;
    }

    public function favorite(Blog $blog)
    {
        $checkFavorite = Favorite::where([
            'user_id' => auth()->user()->id,
            'favoriteable_id' => $blog->id
        ])->exists();

        if ($checkFavorite) {
            $result = $this->favoriteService->deleteFavoriteBlog($blog->id);

            if ($result['code'] != Response::HTTP_OK) {
                return response()->apiErrors($result);
            }

            return response()->apiSuccess($result);
        }

        $result = $this->favoriteService->addFavoriteBlog($blog->id);

        if ($result['code'] != Response::HTTP_OK) {
            return response()->apiErrors($result);
        }

        return response()->apiSuccess($result);
    }


}
