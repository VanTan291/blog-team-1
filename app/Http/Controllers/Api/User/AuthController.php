<?php
/**
 * This is auth Controllers using for authentication user
 *
 * @package App\Http\Controllers\Api\User
 */

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Api\User\RegisterRequest;
use App\Services\Api\User\AuthService;
use Exception;
use Illuminate\Http\Response;
use App\Http\Requests\Api\User\VerifyEmailRequest;
use App\Http\Requests\Api\User\ReSendVerifyEmailRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use JWTAuth;

/**
 * Class AuthController
 */
class AuthController extends Controller
{
    /**
     * Constructor.
     *
     * @param AuthService $authService Authentication service.
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Register user with email and password.
     *
     * @param RegisterRequest $request Request object.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        try {
            DB::beginTransaction();

            $register = $this->authService
                ->register($request->validated());


            if ($register['code'] != Response::HTTP_OK) {
                return response()->apiErrors($register);
            }

            DB::commit();

            return response()->apiSuccess($register);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();

            return response()->apiErrors(
                [
                    'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => __('auth.register_error'),
                ]
            );
        }//end try
    }

    /**
     * Verify email code.
     *
     * @param VerifyEmailRequest $request Including email and code.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyEmailCode(VerifyEmailRequest $request)
    {
        $verify = $this->authService->verifyEmailCode($request->validated());

        if ($verify['code'] != Response::HTTP_OK) {
            return response()->apiErrors($verify);
        }

        return response()->apiSuccess($verify);
    }

    /**
     * Resend verify email code.
     *
     * @param ReSendVerifyEmailRequest $request Including email.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function reSendVerifyEmail(ReSendVerifyEmailRequest $request)
    {
        try {
            DB::beginTransaction();

            $resend = $this->authService->reSendVerifyEmail($request->email);

            if ($resend['code'] != Response::HTTP_OK) {
                return response()->apiErrors($resend);
            }

            DB::commit();

            return response()->apiSuccess($resend);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();

            return response()->apiErrors(
                [
                    'message' => __('auth.send_email_verify_code_error'),
                    'code' => Response::HTTP_INTERNAL_SERVER_ERROR
                ]
            );
        }//end try
    }

    public function login(LoginRequest $request)
    {
        $login = $this->authService->login($request->all());

        if ($login['code'] != Response::HTTP_OK) {
            return response()->apiErrors($login);
        }

        return response()->apiSuccess($login);
    }

    public function logout()
    {
        $logout =  $this->authService->logout();

        if ($logout['code'] != Response::HTTP_OK) {
            return response()->apiErrors($logout);
        }

        return response()->apiSuccess($logout);
    }

    public function me(Request $request) {
        dd(auth('api')->user());
    }
}
