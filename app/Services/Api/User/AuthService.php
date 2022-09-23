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
use App\Mail\SendMailVerify;

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
