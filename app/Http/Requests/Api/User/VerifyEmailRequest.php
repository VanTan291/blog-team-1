<?php
/**
 * The request for api verify user.
 *
 * @package App\Http\Requests\Api\User
 */

namespace App\Http\Requests\Api\User;

/**
 * The request for api verify user.
 */
class VerifyEmailRequest extends BaseRequest
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
            'code' => [
                'required',
                'exists:users,email_verify_code',
            ],
        ];
    }
}
