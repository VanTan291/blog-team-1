<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Api\User\BlogService;
use App\Http\Resources\SeriesResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use App\Http\Requests\Api\User\BlogRequest;

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
    public function index()
    {
        //
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
    public function destroy($id)
    {
        //
    }

    public function getListSeries() {
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
}
