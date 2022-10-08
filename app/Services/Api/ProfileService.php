<?php

namespace App\Services\Api;

use App\Models\User;
use App\Models\UserProfile;
use App\Services\BaseService;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            $url = Storage::disk()->put('public', $inputs['avatar']);
            $formData = [
                'gender' => $inputs['gender'] ?? null,
                'address' => $inputs['address'] ?? null,
                'city' => $inputs['city'] ?? null,
                'district' => $inputs['district'] ?? null,
                'wards' => $inputs['wards'] ?? null,
                'birthday' => $inputs['birthday'] ?? null,
                'education' => $inputs['education'] ?? null,
            ];

            $formDataUser = [
                'avatar' =>$url ?? null,
            ];

            $profile = UserProfile::updateOrCreate(['user_id'  => Auth::user()->id], $formData);
            $user = User::updateOrCreate(['id'  => Auth::user()->id], $formDataUser);

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
    public function getProfile()
    {
        try {
            $profile = $this->model->where('user_id', Auth::user()->id)->first();

            $user = User::where('id', Auth::user()->id)->first();

            return [
                'status' => Response::HTTP_OK,
                'profile' => $profile,
                'user' => $user
            ];
        } catch (Exception $e) {
            return [
                'status' => Response::HTTP_FORBIDDEN,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function getUser()
    {
        try {
            $user = User::where('id', Auth::user()->id)->first();

            if ($user) {
                return [
                    'status' => Response::HTTP_OK,
                    'data' => $user,
                ];
            }
        } catch (Exception $e) {
            return [
                'status' => Response::HTTP_FORBIDDEN,
                'message' => $e->getMessage(),
            ];
        }
    }
}
