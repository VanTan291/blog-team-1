<?php

namespace App\Http\Resources;


class TagResource extends BaseResource
{
    public function toArray($request)
    {
       return [
        'id' => $this->id,
        'name' => $this->name,
        'status' => $this->status,
       ];
    }
}
