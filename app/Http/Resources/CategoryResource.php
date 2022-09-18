<?php

namespace App\Http\Resources;


class CategoryResource extends BaseResource
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
