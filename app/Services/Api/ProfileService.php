<?php

namespace App\Services\Api;

use App\Models\User;
use App\Models\UserProfile;
use App\Services\BaseService;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileService extends BaseService
{
    public function __construct(UserProfile $model)
    {
        $this->model = $model;
    }

    public function updateOrCreate($inputs)
    {
        DB::beginTransaction();

        try {
            $formData = [
                'gender' => $inputs['gender'],
                'address' => $inputs['address'],
                'birthday' => $inputs['birthday'],
            ];

            $formDataUser = [
                'name' => $inputs['name'],
                'email' => $inputs['email'],
            ];

            $user = User::updateOrCreate(['id'  => Auth::user()->id], $formDataUser);

            $profile = UserProfile::updateOrCreate(['user_id'  => Auth::user()->id], $formData);

            DB::commit();

            if ($profile && $user) {
                return [
                    'code' => Response::HTTP_OK,
                    'message' => 'Cập nhật profile thành công',
                ];
            }
        } catch (Exception $e) {
            DB::rollBack();
            return [
                'code' => Response::HTTP_FORBIDDEN,
                'message' => $e->getMessage(),
            ];
        }
    }
}
