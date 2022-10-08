<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Api\User\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\BlogController;

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
Route::POST('register', [AuthController::class, 'register']);
Route::POST('verify-email', [AuthController::class, 'verifyEmailCode']);
Route::POST('re-send-verify-email', [AuthController::class, 'reSendVerifyEmail']);
Route::get('list-blog-home', [BlogController::class, 'getListBlogHome']);
Route::get('detail-blog/{blog}', [BlogController::class, 'getDetailBlog']);

Route::group(['middleware' => ['auth.user']], function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);
    Route::resource('tags', TagController::class);
    Route::resource('categories', CategoryController::class);
    Route::post('setup-profile', [ProfileController::class, 'setupProfile']);
    Route::get('get-profile', [ProfileController::class, 'getProfile']);
    Route::get('listCategory', [CategoryController::class, 'getListCategory']);
    Route::get('listTag', [TagController::class, 'getListTag']);
    Route::resource('blogs', BlogController::class);
    Route::get('listSeries', [BlogController::class, 'getListSeries']);
});

