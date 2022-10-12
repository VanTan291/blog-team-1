<?php

namespace App\Http\Resources;

use Carbon\Carbon;

class UserProfileResource extends BaseResource
{
    public function toArray($request)
    {
        $create_date = Carbon::create($this->created_at);

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            "city" => $this->city,
            "district" => $this->district,
            "wards" => $this->wards,
            "gender" => $this->gender,
            "address" => $this->address,
            "education" => $this->education,
            'create_date' => $create_date->diffForHumans(Carbon::now())
        ];
    }
}
