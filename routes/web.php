<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('user/show_data/{user}', [\App\Modules\Auth\User\Controllers\UserDashboardController::class, 'showData']);
Route::get('user/user_statistics/{user}', [\App\Modules\Auth\User\Controllers\UserDashboardController::class, 'userStatistics']);
Route::get('match_requests_vs_users/list', [\App\Modules\Auth\User\Controllers\UserDashboardController::class, 'indexMatchRequests']);
Route::get('user/user_reports', [\App\Modules\Auth\User\Controllers\UserDashboardController::class, 'userReports']);
Route::get('index_user_reports', [\App\Modules\Auth\User\Controllers\UserDashboardController::class, 'indexUserReports']);
Route::get('setting/all', function (Request $request) {
    return response()->json(['message' => '', 'data' => ['app' => ['langs' => ['en']]]], 200);
});
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::resource('admins', \App\Modules\Auth\Admin\Controllers\AdminDashboardController::class);
});
