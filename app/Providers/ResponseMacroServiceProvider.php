<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Response as ResponseHttp;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('apiSuccess', function ($data, $code = ResponseHttp::HTTP_OK, $message = null) {
            return response()->json(
                array_merge([
                    'code' => ResponseHttp::HTTP_OK,
                ], $data), $code
            );
        });

        Response::macro('apiErrors', function ($message = null, $code = ResponseHttp::HTTP_FORBIDDEN) {
            return response()->json(
                array_merge([
                    'code' => $code,
                    'message' => $message
                ], $message), $code);
        });
    }
}
