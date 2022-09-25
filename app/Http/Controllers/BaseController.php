<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class BaseController extends Controller
{
    public function responseErrors($message = '', $statusCode = Response::HTTP_FORBIDDEN)
    {
        return apiErrors($message, $statusCode);
    }

    public function responseSuccess($data, $statusCode = Response::HTTP_OK)
    {
        return apiSuccess($data, $statusCode);
    }
}
