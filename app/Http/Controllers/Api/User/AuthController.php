<?php
/**
 * This is auth Controllers using for authentication user
 *
 * @package App\Http\Controllers\Api\User
 */

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Api\User\RegisterRequest;
use App\Services\Api\User\AuthService;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

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

    public function login(Request $request)
    {
        try {
            DB::beginTransaction();
            Config::set('jwt.user', 'App\User');
            Config::set('auth.providers.users.model', \App\User::class);
            $token = null;

            if ($token = JWTAuth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return response()->json([
                    'code' => Response::HTTP_OK,
                    'response' => __('auth.success'),
                    'result' => [
                        'token' => $token,
                    ],
                ], 200);
            } else {
                return response()->json([
                    'code' => Response::HTTP_BAD_REQUEST,
                    'response' => 'error',
                    'message' => __('auth.login_error'),
                ], 400);
            }

            DB::commit();

        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollback();

            return response()->json(
                [
                    'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => __('auth.login_error'),
                ], 500
            );
        }

    }

    public function logout()
    {
        if(Auth::check() == false)
        {
            return response()->json([
                'code' => Response::HTTP_UNAUTHORIZED,
                'message' => 'Unauthorized'
            ], 401);
        }

        Auth::guard('api')->logout();
        return response()->json([
            'message' => __('auth.logout_success'),
        ], 200);
    }
}
