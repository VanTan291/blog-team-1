<?php

namespace App\Http\Resources;


class BlogResource extends BaseResource
{
    public function toArray($request)
    {
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
            'status' => $this->is_published
        ];
    }
}
