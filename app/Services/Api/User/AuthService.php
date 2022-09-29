<?php
/**
 * This is auth service using for authentication user
 *
 * @package App\Services\Api\User
 */

namespace App\Services\Api\User;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Mail\SendMailVerify;
use Illuminate\Support\Facades\Auth;
use JWTAuth;

/**
 * Class AuthService
 */
class AuthService extends BaseService
{
    /**
     * This is contructor for auth service.
     *
     * @param \App\Model\User $user This is user model.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * This is method for register with email user.
     *
     * @param array $params This is data including email and password for register user.
     *
     * @return array This is response data including status and message.
     */
    public function register(array $params)
    {
        DB::beginTransaction();

        try {
            $code = $this->sendEmailVerifyCode($params['email']);

            if (!$code) {
                return [
                    'code' => Response::HTTP_SERVICE_UNAVAILABLE,
                    'message' => __('auth.send_email_verify_code_error'),
                ];
            }

            $params['email_verify_code'] = $code;

            $user = $this->user->create($params);
            $user->profile()->create([]);

            DB::commit();

            return [
                'message' => __('auth.register_success'),
                'code' => Response::HTTP_OK
            ];
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return [
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => __('auth.register_error'),
            ];
        }//end try
    }

    public function login($inputs)
    {
        $token = null;
        $response = null;

        if ($token = JWTAuth::attempt(['email' => $inputs['email'], 'password' => $inputs['password']])) {
            if (auth('api')->user()->status != UserStatus::ACTIVE) {
                $response = [
                    'code' => Response::HTTP_LOCKED,
                    'message' => __('auth.unverified_email'),
                ];
            } else {
                $response = [
                    'code' => Response::HTTP_OK,
                    'message' => __('auth.success'),
                    'token' => $token
                ];
            }
        } else {
            $response = [
                'code' => Response::HTTP_FORBIDDEN,
                'message' => __('auth.login_error'),
            ];
        }

        return $response;
    }

    public function logout()
    {
        if(Auth::check() == false)
        {
            return [
                'code' => Response::HTTP_UNAUTHORIZED,
                'message' =>  __('auth.unauthorized'),
            ];
        }

        Auth::guard('api')->logout();

        return [
            'code' => Response::HTTP_OK,
            'message' => __('auth.logout_success'),
        ];
    }

    /**
     * This is method for verify email code.
     *
     * @param array $params This is data including email and code for verify email.
     *
     * @return array This is response data including status and message.
     */
    public function verifyEmailCode(array $params)
    {
        $user = $this->user
            ->where('email', $params['email'])
            ->first();

        if ($user->email_verify_code != $params['code']) {
            return [
                'code' => Response::HTTP_UNAUTHORIZED,
                'message' => __('auth.email_verify_code_error'),
            ];
        }

        $user->update(
            [
                'status' => UserStatus::ACTIVE,
                'email_verify_code' => null,
                'email_verified_at' => now(),
            ]
        );

        return [
            'code' => Response::HTTP_OK,
            'token' => auth('api')->login($user),
            'message' => __('auth.email_verify_success'),
        ];
    }

    /**
     * This is method for send email verify code.
     *
     * @param string $email This is email for send email verify code.
     *
     * @return string This is email verify code.
     */
    public function reSendVerifyEmail(string $email)
    {
        $user = $this->user
            ->select('id', 'email_verify_code')
            ->where('email', $email)
            ->first();

        if (!$user) {
            return [
                'message' => __('auth.not_found'),
                'code' => Response::HTTP_UNAUTHORIZED
            ];
        }

        $code = $this->sendEmailVerifyCode($email);

        if (!$code) {
            return [
                'message' => __('auth.send_email_verify_code_error'),
                'code' => Response::HTTP_SERVICE_UNAVAILABLE
            ];
        }

        $user->update(['email_verify_code' => $code]);

        return [
            'message' => __('auth.resend_verify_email_success'),
            'code' => Response::HTTP_OK
        ];
    }

    /**
     * Send verify code user.
     *
     * @param string $email Email of user.
     *
     * @return string
     */
    protected function sendEmailVerifyCode(string $email)
    {
        $code = rand(1000, 9999);
        Mail::to($email)->send(new SendMailVerify($code));

        return $code;
    }
}
