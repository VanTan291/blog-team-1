<?php
/**
 * This is blog service
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
use App\Models\Tag;
use App\Models\Taggable;
use Illuminate\Support\Facades\Storage;
use App\Enums\BlogStatus;

/**
 * Class BlogService
 */
class BlogService extends BaseService
{
    const ACTIVE = 1;
    /**
     * This is contructor for blog service.
     *
     * @param \App\Model\Blog $blog This is blog model.
     */
    public function __construct(Blog $model)
    {
        $this->model = $model;
    }

    public function index(User $user)
    {
        try {
            $blogs = $this->model->where('user_id', $user->id)->latest('id');

            if ($blogs) {
                return [
                    'status' => Response::HTTP_OK,
                    'data' => $blogs,
                ];
            }
        } catch (Exception $e) {
            return [
                'status' => Response::HTTP_FORBIDDEN,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function getListSeries()
    {
        return BlogSeries::all();
    }

    public function createBlog(User $user, $params)
    {
        DB::beginTransaction();
        try {
            if (BlogSeries::where('title', $params['series'])->exists()) {
                $blogSeries = BlogSeries::where('title', $params['series'])->first();
            } else if (isset($params['series']) && $params['series'] != '') {
                $blogSeries = BlogSeries::create([
                    'user_id' => $user->id,
                    'title' => $params['series']
                ]);
            }

            $url = Storage::disk()->put('public', $params['thumbnail']);

            $blog = $this->model->create([
                'user_id' => $user->id ?? null,
                'categories_id' => $params['category'] ?? null,
                'series_id' => $blogSeries->id ?? null,
                'title' => $params['title'] ?? null,
                'content' => $params['content'] ?? null,
                'description' => $params['description'] ?? null,
                'thumbnail' => $url ?? null,
                'is_published' => self::ACTIVE
            ]);

            foreach(json_decode($params['tags']) as $item) {
                if ($item->id == '') {
                    $blog->tags()->create([
                        'name' => $item->name,
                        'status' => self::ACTIVE
                    ]);
                } else {
                    $tag = Tag::find($item->id);
                    $blog->tags()->attach($tag);
                }
            }

            DB::commit();
            return [
                'code' => Response::HTTP_OK,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);

            return [
                'code' => Response::HTTP_FORBIDDEN,
            ];
        }
    }

     public function getListBlogHome($params)
    {
        try {
            $blogTrends = $this->model
                ->where([
                    ['views', '>', 10],
                    ['is_published', BlogStatus::ACTIVE]
                ])
                ->skip(0)
                ->take(4)
                ->get();

            $blogs = $this->model
                ->where([
                    ['is_published', BlogStatus::ACTIVE]
                ])
                ->latest('id');

            if ($blogs) {
                return [
                    'status' => Response::HTTP_OK,
                    'blogTrends' => $blogTrends,
                    'blogs' => $blogs
                ];
            }
        } catch (Exception $e) {
            return [
                'status' => Response::HTTP_FORBIDDEN,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function getListOfRelatedBlogs($blog, $params)
    {
        try {
            $getListOfRelatedBlogs = $this->model->where([
                ['id', '<>', $blog->id],
                ['series_id', '=', $blog->series_id],
                ['is_published', BlogStatus::ACTIVE]
            ])
            ->get();

            if ($getListOfRelatedBlogs) {
                return [
                    'status' => Response::HTTP_OK,
                    'data' => $getListOfRelatedBlogs,
                ];
            }

        } catch (Exception $e) {
            return [
                'status' => Response::HTTP_FORBIDDEN,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function destroy($blog)
    {
        try {
            $blog->delete();

            if ($blog) {
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
