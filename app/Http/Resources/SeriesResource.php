<?php

namespace App\Http\Resources;


class SeriesResource extends BaseResource
{
    public function toArray($request)
    {
       return [
        'id' => $this->id ?? '',
        'user_id' => $this->user_id ?? '',
        'title' => $this->title ?? ''
       ];
    }
}
