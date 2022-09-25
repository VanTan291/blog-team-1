<?php
/**
 * The request for api register user.
 *
 * @package App\Http\Requests\Api\User
 */

namespace App\Http\Requests\Api\User;

use Illuminate\Validation\Rule;

/**
 * The request for api register user.
 */
class RegisterRequest extends BaseRequest
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
                'unique:users,email',
                'email',
            ],
            'password' => [
                'required',
                'min:6',
                'confirmed'
            ],
            'name' => [
                'required',
                'min:5',
                'max:15',
                'alpha_dash',
                Rule::unique('users')->where(
                    function ($query) {
                        $query->where('email', '!=', $this->email);
                    }
                ),
            ],
            'password_confirmation' => [
                'required',
                'min:6',
            ]
        ];
    }
}
