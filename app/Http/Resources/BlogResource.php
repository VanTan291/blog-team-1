<?php

namespace App\Http\Resources;

use App\Models\Bookmark;
use Carbon\Carbon;
use App\Models\Follow;

class BlogResource extends BaseResource
{
    public function toArray($request)
    {
        $create_date = Carbon::create($this->created_at);

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'category' => $this->category->name,
            'blog_series' => $this->when($this->series, $this->series->title ?? ''),
            'content' => $this->content,
            'thumbnail' => $this->thumbnail_url,
            'description' => $this->description,
            'views' => $this->views,
            'favorites' => $this->favorites,
            'tags' => $this->when($this->tags, $this->tags ?? ''),
            'status' => $this->is_published,
            'create_date' => $create_date->diffForHumans(Carbon::now()),
            'check_bookmark' => $this->when(Bookmark::where([
                'blog_id' => $this->id,
                'user_id' => auth()->user()->id ?? null,
            ])->exists(), true),
            'is_follow' => $this->user_id != (auth()->user()->id ?? null)
                ? Follow::where('to_user_id', $this->user_id)->exists()
                : true
        ];
    }
}