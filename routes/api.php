<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'system','as' => 'system.'], function () {
    Route::post('/info', function (Request $request) {
        return response()->json([
            'success' => true,
            'message' => 'To Boldly Go.',
            'ret' => [
                'product' => "NOJ",
                'version' => version()
            ],
            'err' => []
        ]);
    })->name("info");
});

Route::group(['prefix' => 'account','as' => 'account.'], function () {
    Route::post('/login', function (Request $request) {
        if(rand(0,1)){
            return response()->json([
                'success' => false,
                'message' => 'Email/Password Wrong.',
                'ret' => [],
                'err' => [
                    'code' => 1100,
                    'msg' => 'Email/Password Wrong.'
                ]
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Successfully Login.',
                'ret' => [
                    "token" => md5(time()),
                    "user" => [
                        "id" => 1,
                        "name" => "admin",
                        "avatar" => url("/static/img/avatar/SDL0ohVXn85VzcpCfu5QQMVvdGpg2F0BFbriLQnI.jpeg"),
                        "email" => "admin@code.master",
                        "email_verified_at" => null,
                        "professional_rate" => 1628,
                        "contest_account" => null,
                        "created_at" => "2019-02-10 10:53:04",
                        "updated_at" => "2019-07-19 00:43:26",
                        "describes" => "# 123",
                        "prefix" => null
                    ]
                ],
                'err' => []
            ]);
        }
    })->name("login");
});
