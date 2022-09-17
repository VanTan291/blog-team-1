<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    public $resource;

    public function __construct($resource)
    {
        static::$wrap = 'data';
        $this->resource = $resource;
    }

    public static function apiPaginate($query, Request $request)
    {
        $pageSize = config('api.pagination.per_page');

        if (($pageSizeInput = (int) $request->page_size) > 0) {
            $pageSize = min($pageSizeInput, config('api.pagination.max_per_page'));
        }

        return static::collection($query->paginate($pageSize)->appends($request->query()))
            ->response()
            ->getData();
    }

    public static function apiDataResult($data)
    {
        return static::collection($data)
            ->response()
            ->getData();
    }
}
