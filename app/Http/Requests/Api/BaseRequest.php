<?php
/**
 * This package is based request on the Laravel Framework.
 *
 * @package App\Http\Reuqest\Api
 */

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

/**
 * The base request class for api login user.
 */
class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return string
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param Validator $validator The validator object.
     *
     * @return void
     * @throws ValidationException If validation fails.
     */
    public function failedValidation(Validator $validator)
    {
        $message = $validator->errors()->toArray();
        // foreach ($validator->errors()->toArray() as $item) {
        //     $message = $item[0];
        //     break;
        // }

        $statusCodeError = Response::HTTP_FORBIDDEN;
        $json = [
            'code' => $statusCodeError,
            'message' => $message,
        ];
        $response = new JsonResponse($json, $statusCodeError);
        throw (new ValidationException($validator, $response))
            ->status($statusCodeError);
    }
}
