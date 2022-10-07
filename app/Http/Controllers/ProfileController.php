<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\ProfileRequest;
use App\Models\User;
use App\Services\Api\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        // if ($result['code'] == Response::HTTP_OK) {
        //     return $this->responseSuccess($result);
        // }

        // return $this->responseErrors($result['message']);
    }
}
