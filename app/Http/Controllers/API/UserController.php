<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirmPassword' => 'required|same:password',
            'birthday' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        UserProfile::create([
            'user_id' => $user->id,
            'birthday' => $request->birthday,
        ]);

        $success['token'] =  $user->createToken('Blog')->accessToken;
        $success['name'] =  $user->name;
        $success['email'] =  $user->email;

        return response()->json(['success' => $success], 200);
    }
}
