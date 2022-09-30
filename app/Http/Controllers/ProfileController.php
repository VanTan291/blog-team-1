<?php

namespace App\Http\Controllers;

use App\Services\Api\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends BaseController
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    public function setupProfile(Request $request)
    {
        $result = $this->profileService->updateOrCreate($request->all());
        // dd($result);
    }
}
