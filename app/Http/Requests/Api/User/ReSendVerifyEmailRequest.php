<?php
/**
 * The request for api re-send verify email user.
 *
 * @package App\Http\Requests\Api\User
 */

namespace App\Http\Requests\Api\User;
use App\Http\Requests\Api\BaseRequest;

/**
 * The request for api re-send verify email user.
 */
class ReSendVerifyEmailRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
                'exists:users,email',
            ],
        ];
    }
}
