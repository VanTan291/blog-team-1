<?php

namespace App\Services\Api;

use App\Models\UserProfile;
use App\Services\BaseService;
use Exception;
use Illuminate\Http\Response;

class ProfileService extends BaseService
{
    public function __construct(UserProfile $model)
    {
        $this->model = $model;
    }

    public function updateOrCreate($inputs)
    {
        
    }
}
