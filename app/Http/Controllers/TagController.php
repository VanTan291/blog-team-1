<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use App\Services\Api\TagService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TagController extends BaseController
{
    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function index(Request $request)
    {
        $result = $this->tagService->index();

        if ($result['status'] == Response::HTTP_OK) {
            return $this->responseSuccess([
                'data' => TagResource::apiPaginate($result['data'], $request),
                'code' => Response::HTTP_OK
            ]);
        }

        return $this->responseErrors($result['message']);
    }

    public function store(TagRequest $request)
    {
        $result = $this->tagService->store($request->validated());

        if ($result['status'] == Response::HTTP_CREATED) {
            return $this->responseSuccess([
                'code' => Response::HTTP_OK
            ]);
        }

        return $this->responseErrors($result['message']);
    }

    public function show(Tag $tag)
    {
        if ($tag) {
            return $this->responseSuccess([
                'data' => new TagResource($tag),
                'code' => Response::HTTP_OK
            ]);
        }
       
        return $this->responseErrors('Category not found');
    }

    public function update(Tag $tag, TagRequest $request)
    {
        $result = $this->tagService->update($request->validated(), $tag);

        if ($result['status'] == Response::HTTP_OK) {
            return $this->responseSuccess([
                'data' => new TagResource($tag),
                'code' => Response::HTTP_OK
            ]);
        }

        return $this->responseErrors($result['message']);
    }

    public function destroy(Tag $tag)
    {
        $result = $this->tagService->destroy($tag);

        if ($result['status'] == Response::HTTP_OK) {
            return $this->responseSuccess([
                'code' => Response::HTTP_OK
            ]);
        }

        return $this->responseErrors($result['message']);
    }
}
