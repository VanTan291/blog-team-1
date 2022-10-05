<?php

namespace App\Http\Resources;

use Carbon\Carbon;

class BlogResource extends BaseResource
{
    public function toArray($request)
    {
        $create_date = Carbon::create($this->created_at);

        return [
            'id' => $this->id,
            'title' => $this->title,
            'category' => $this->category->name,
            'blog_series' => $this->series->title,
            'content' => $this->content,
            'thumbnail' => $this->thumbnail_url,
            'description' => $this->description,
            'views' => $this->views,
            'favorites' => $this->favorites,
            'tags' => $this->when($this->tags, $this->tags ?? ''),
            'status' => $this->is_published,
            'create_date' => $create_date->diffForHumans(Carbon::now())
        ];
    }
}
