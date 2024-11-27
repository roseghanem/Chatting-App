<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Modules\Auth\User\Models\User;
use \Illuminate\Support\Facades\Hash;
use \Carbon\Carbon;

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

Route::post('user/login', function (Request $request) {
    $user = User::Where('phone', $request->phone)->first();
    if ($user && Hash::check($request->password, $user->password)) {
        $objToken = $user->createToken('User', ['user']);
        $strToken = $objToken->accessToken;
        $expiration = $objToken->token->expires_at->diffInSeconds(Carbon::now());
        $user->login_times = $user->login_times + 1;
        $user->update();
        $user->login_times = $user->login_times - 1;
        $response = \App\Helpers\Helper::createSuccessResponse([
            "exist" => $user->email ? true : false,
            "token_type" => "Bearer",
            "token" => $strToken,
            'user' => $user
        ], "Welcome back $user->name");
        return response()->json($response, 200);
    } else {
        return response()->json(['error' => 'Unauthorized', 'message' => 'Unauthorized', 'data' => null], 401);
    }
});

Route::get('logged-user/info', function () {
    $user = \Illuminate\Support\Facades\Auth::guard('api')->user();
    if ($user) {
        $objToken = $user->createToken('User', ['user']);
        $strToken = $objToken->accessToken;
        $expiration = $objToken->token->expires_at->diffInSeconds(Carbon::now());
        $user->login_times = $user->login_times + 1;
        $user->update();
        $user->login_times = $user->login_times - 1;
        $response = \App\Helpers\Helper::createSuccessResponse([
            "exist" => $user->email ? true : false,
            "token_type" => "Bearer",
            "token" => $strToken,
            'user' => $user
        ], "Welcome back $user->name");
        return response()->json($response, 200);
    } else {
        return response()->json(['error' => 'Unauthorized', 'message' => 'Unauthorized', 'data' => null], 401);
    }
});

Route::post('user/check-exist', function (Request $request) {
    if (isset($request->phone)) {
        $user = User::Where('phone', $request->phone)->first();
        if ($user) {
            $response = \App\Helpers\Helper::createSuccessResponse([
                "type" => "phone",
                "exist" => true,
            ], "Phone number is exist");
            return response()->json($response, 200);
        } else {
            $response = \App\Helpers\Helper::createSuccessResponse([
                "type" => "phone",
                "exist" => false,
            ], "");
            return response()->json($response, 200);
        }
    } elseif (isset($request->email)) {
        $user = User::Where('email', $request->email)->first();
        if ($user) {
            $response = \App\Helpers\Helper::createSuccessResponse([
                "type" => "email",
                "exist" => true,
            ], "Email is exist");
            return response()->json($response, 200);
        } else {
            $response = \App\Helpers\Helper::createSuccessResponse([
                "type" => "email",
                "exist" => false,
            ], "");
            return response()->json($response, 200);
        }
    }
    $response = \App\Helpers\Helper::createErrorResponse([
        "type" => null,
        "exist" => false,
    ], "No type requested");
    return response()->json($response, 500);
});

Route::post('admin/login', function (Request $request) {
    $admin = \App\Modules\Auth\Admin\Models\Admin::Where('email', $request->email)->first();
    if ($admin && Hash::check($request->password, $admin->password)) {
        $objToken = $admin->createToken('Admin');
        $strToken = $objToken->plainTextToken;
        $admin['abilities'] = [
            [
                'subject' => 'all',
                'action' => 'manage'
            ]
        ];
        $response = \App\Helpers\Helper::createSuccessResponse([
            "token_type" => "Bearer",
            "token" => $strToken,
            'user' => $admin
        ], "Welcome back $admin->name");
        return response()->json($response, 200);
    } else {
        return response()->json(['error' => 'Unauthorized', 'message' => 'Unauthorized', 'data' => null], 401);
    }
});

Route::middleware('auth:sanctum')->get('admin/info', function (Request $request) {
    $admin = $request->user();
    if ($admin) {
        $objToken = $admin->createToken('Admin');
        $strToken = $objToken->plainTextToken;
        $admin['abilities'] = [
            [
                'subject' => 'all',
                'action' => 'manage'
            ]
        ];
        $response = \App\Helpers\Helper::createSuccessResponse([
            "token_type" => "Bearer",
            "token" => $strToken,
            'user' => $admin
        ], "Welcome back $admin->name");
        return response()->json($response, 200);
    } else {
        return response()->json(['error' => 'Unauthorized', 'message' => 'Unauthorized', 'data' => null], 401);
    }
});
