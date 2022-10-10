<?php
/**
 * This is bookMark service
 *
 * @package App\Services\Api\User
 */

namespace App\Services\Api\User;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use App\Models\Blog;
use App\Models\User;
use App\Models\BlogSeries;
use App\Models\Bookmark;
use App\Models\Tag;
use App\Models\Taggable;
use Illuminate\Support\Facades\Storage;

/**
 * Class BookMarkService
 */
class BookMarkService extends BaseService
{
    /**
     * This is contructor for bookMark service.
     *
     * @param \App\Model\Blog $blog This is blog model.
     */
    public function __construct(Bookmark $model)
    {
        $this->model = $model;
    }

    public function store($blog) {
        try {
            $makeBookMark = $this->model->create([
                'blog_id' => $blog->id,
                'user_id' => auth()->user()->id
            ]);

            return [
                'code' => Response::HTTP_OK,
                'data' => $makeBookMark
            ];
        }catch (Exception $e) {
            Log::info($e);

            return [
                'code' => Response::HTTP_FORBIDDEN,
            ];
        } 
    }

    public function destroy ($blogId)
    {
        try {
            $this->model->where([
                    'blog_id' => $blogId,
                    'user_id' => auth()->user()->id
            ])->delete();

            return [
                'code' => Response::HTTP_OK
            ];
        }catch (Exception $e) {
            Log::info($e);

            return [
                'code' => Response::HTTP_FORBIDDEN
            ];
        }
    }
}
