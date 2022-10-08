<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\ProfileRequest;
use App\Http\Resources\UserProfileResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\Api\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ProfileController extends BaseController
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function setupProfile(ProfileRequest $request)
    {
        $result = $this->profileService->updateOrCreate($request->all());

        if ($result['code'] != Response::HTTP_OK) {
            return response()->apiErrors($result);
        }

        return response()->apiSuccess($result);
    }

    public function getProfile()
    {
        $userProfile = $this->profileService->getProfile();

        if ($userProfile['status'] == Response::HTTP_OK) {
            return response()->apiSuccess([
                'dataProfile' => UserProfileResource::make($userProfile['profile']),
                'dataUser' => UserResource::make($userProfile['user']),
            ]);
        }

        return response()->apiErrors($userProfile);
    }
}
