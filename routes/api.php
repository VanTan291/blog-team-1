<?php

use App\Http\Controllers\Api\User\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::POST('register', [AuthController::class, 'register'])->name('register');
Route::POST('verify-email', [AuthController::class, 'verifyEmailCode'])->name('verify_email_code');
Route::POST('re-send-verify-email', [AuthController::class, 'reSendVerifyEmail'])->name('re_send_verify_email');

// Route::middleware('auth:api')->get('/user', function(Request $request){
//     return $request->user();
// });

Route::group(['middleware' => ['auth.user']], function () {
    Route::get('me', [AuthController::class, 'me'])->name('me');
});
