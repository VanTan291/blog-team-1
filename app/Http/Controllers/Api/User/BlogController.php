<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Api\User\BlogService;
use App\Http\Resources\SeriesResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use App\Http\Requests\Api\User\BlogRequest;
use App\Http\Resources\BlogResource;
use App\Models\Blog;

class BlogController extends Controller
{
    /**
     * Constructor.
     *
     * @param BlogService $blogService blog service.
     */
    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth('api')->user();

        $result = $this->blogService->index($user);

        if ($result['status'] == Response::HTTP_OK) {
            return response()->apiSuccess([
                'data' => BlogResource::apiPaginate($result['data'], $request),
                'code' => Response::HTTP_OK
            ]);
        }

        return response()->apiErrors($result['message']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        $user = auth('api')->user();

        $created = $this->blogService->createBlog($user, $request->all());
        if ($created['code'] === Response::HTTP_OK) {
            return response()->apiSuccess([
                'message' => __('messages.create_success'),
            ]);
        }

        return response()->apiErrors(__('messages.create_error'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $result = $this->blogService->destroy($blog);

        if ($result['status'] == Response::HTTP_OK) {
             return response()->apiSuccess([
                'code' => Response::HTTP_OK,
            ]);
        }

        return response()->apiErrors($result['message']);
    }

    public function getListSeries()
    {
        try {
            $listSeries = $this->blogService->getListSeries();

            return response()->apiSuccess([
                'data' => SeriesResource::collection($listSeries)
            ]);
        } catch (\Exception $e) {
            Log::error($e);

            return response()->apiErrors(__('messages.get_error'));
        }
    }

    public function getListBlogHome(Request $request)
    {
        $result = $this->blogService->getListBlogHome($request->all());

        if ($result['status'] == Response::HTTP_OK) {
            return response()->apiSuccess([
                'blogTrends' => BlogResource::collection($result['blogTrends'], $request),
                'blogs' => BlogResource::apiPaginate($result['blogs'], $request),
                'code' => Response::HTTP_OK
            ]);
        }

        return response()->apiErrors($result['message']);
    }

    public function getDetailBlog(Request $request, Blog $blog)
    {
        $getListOfRelatedBlogs = $this->blogService->getListOfRelatedBlogs($blog, $request->all());

        if ($blog) {
            return response()->apiSuccess([
                'data' => new BlogResource($blog, $request),
                'listOfRelatedBlogs' => BlogResource::collection($getListOfRelatedBlogs['data'], $request),
                'code' => Response::HTTP_OK
            ]);
        }

        return response()->apiErrors($getListOfRelatedBlogs['message']);
    }
}
