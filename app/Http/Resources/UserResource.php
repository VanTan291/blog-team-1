<?php

namespace App\Http\Resources;

use Carbon\Carbon;

class UserResource extends BaseResource
{
    public function toArray($request)
    {
        $create_date = Carbon::create($this->created_at);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'avatar' => $this->avatar_url,
            'create_date' => $create_date->diffForHumans(Carbon::now()),
            'number_blog' => $this->blogs->count(),
            'followers' => $this->followers->count(),
            'following'=> $this->following->count()
        ];
    }
}
