<?php

namespace App\Http\Resources;

use App\Models\Bookmark;
use App\Models\Favorite;
use Carbon\Carbon;
use App\Models\Follow;
use App\Http\Resources\TagResource;
use App\Http\Resources\SeriesResource;
use App\Http\Resources\CategoryResource;

class DetailBlogResource extends BaseResource
{
    public function toArray($request)
    {
        $create_date = Carbon::create($this->created_at);

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'category' => $this->when($this->category, new CategoryResource($this->category) ?? ''),
            'series' => $this->when($this->series, new SeriesResource($this->series) ?? ''),
            'content' => $this->content,
            'thumbnail' => $this->thumbnail,
            'file' => $this->thumbnail_url,
            'description' => $this->description,
            'tags' => $this->when($this->tags, TagResource::collection($this->tags) ?? ''),
            'status' => $this->is_published,
        ];
    }
}