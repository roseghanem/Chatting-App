<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Helpers\Files;
use App\Helpers\Helper;

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

Route::get('users/list', [\App\Modules\Auth\User\Controllers\UserDashboardController::class, 'index']);
Route::post('users', [\App\Modules\Auth\User\Controllers\UserController::class, 'store']);
Route::post('agora/get-token', [\App\Modules\Auth\User\Controllers\UserDashboardController::class, 'generateToken']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('unmatch_user', [\App\Modules\Auth\User\Controllers\UserController::class, 'unmatchUser']);
    Route::post('block-user', [\App\Modules\Auth\User\Controllers\UserController::class, 'storeBlackListed']);
    Route::post('open-bubble', [\App\Modules\Auth\User\Controllers\UserController::class, 'storeOpenedBubbles']);
    Route::post('user/update', [\App\Modules\Auth\User\Controllers\UserController::class, 'update']);
    Route::post('users/matchings', [\App\Modules\Auth\User\Controllers\UserController::class, 'matchings']);
    Route::get('users/match_requests', [\App\Modules\Auth\User\Controllers\UserController::class, 'matchRequests']);
    Route::get('users/match_requests/likes', [\App\Modules\Auth\User\Controllers\UserController::class, 'likesMatchRequests']);
    Route::get('users/match_requests/superlikes', [\App\Modules\Auth\User\Controllers\UserController::class, 'superLikesMatchRequests']);
    Route::get('users/match_queue', [\App\Modules\Auth\User\Controllers\UserController::class, 'matchQueue']);
    Route::post('users/match_request/send/{user}', [\App\Modules\Auth\User\Controllers\UserController::class, 'sendMatchRequest']);
    Route::post('users/match_request/accept/{user}', [\App\Modules\Auth\User\Controllers\UserController::class, 'acceptMatchUser']);
    Route::post('users/match_request/decline/{user}', [\App\Modules\Auth\User\Controllers\UserController::class, 'declineMatchUser']);
    Route::post('notifications/store_token', [\App\Modules\Auth\Notification\Controllers\NotificationController::class, 'storeToken'])->name('notifications.storeToken');
    Route::post('notifications/end', [\App\Modules\Auth\Notification\Controllers\NotificationController::class, 'store'])->name('notifications.send');
    Route::post('user/report', [\App\Modules\Auth\User\Controllers\UserController::class, 'reportUser']);
    Route::delete('user/destroy', [\App\Modules\Auth\User\Controllers\UserController::class, 'destroy']);
    Route::get('user/{user}', [\App\Modules\Auth\User\Controllers\UserController::class, 'show']);
    Route::put('user/subscription/{user}', [\App\Modules\Auth\User\Controllers\UserController::class, 'editSubscription']);
    Route::resource('calls', \App\Modules\Call\Controllers\CallController::class);
    Route::resource('viewed_statuses', \App\Modules\ViewedStatus\Controllers\ViewedStatusController::class);
    Route::resource('languages', \App\Modules\Language\Controllers\LanguageController::class);
    Route::post('file/upload', function (Request $request) {
        return Helper::createSuccessResponse(['file' => Files::defaultUpload($request['file'])], 'File uploaded successfully');
    })->name('file.upload');
});
