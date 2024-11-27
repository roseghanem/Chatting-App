<?php

namespace App\Modules\Auth\User\Controllers;

use App\Helpers\Helper;
use App\Modules\Auth\User\Actions\AccessToken;
use App\Modules\Auth\User\Actions\DynamicTokenClass;
use App\Modules\Auth\User\Actions\RtcTokenBuilder;
use App\Modules\Auth\User\Actions\RtcTokenBuilder2;
use App\Http\Controllers\Controller;
use App\Modules\Auth\User\Actions\DeleteUserAction;
use App\Modules\Auth\User\Actions\StoreBlackListedAction;
use App\Modules\Auth\User\Actions\StoreUserAction;
use App\Modules\Auth\User\Actions\StoreUserReportsAction;
use App\Modules\Auth\User\Actions\UpdateUserAction;
use App\Modules\Auth\User\DataTables\MatchRequestDataTable;
use App\Modules\Auth\User\DataTables\UserReportsDataTable;
use App\Modules\Auth\User\DTO\BlackListedDTO;
use App\Modules\Auth\User\DTO\UserDTO;
use App\Modules\Auth\User\DTO\StoreUserReportsDTO;
use App\Modules\Auth\User\Models\User;
use App\Modules\Auth\User\Requests\ShowDataUserRequest;
use App\Modules\Auth\User\Requests\StoreBlackListedRequest;
use App\Modules\Auth\User\Requests\StoreUserRequest;
use App\Modules\Auth\User\Requests\UpdateUserRequest;
use App\Modules\Auth\User\Requests\StoreUserReportsRequest;
use App\Modules\Auth\User\Requests\UserStatisticsRequest;
use App\Modules\Auth\User\ViewModels\Dashboard\TotalNumOfBlockedVM;
use App\Modules\Auth\User\ViewModels\Dashboard\TotalNumOfChatsVM;
use App\Modules\Auth\User\ViewModels\Dashboard\TotalNumOfGettingBlockedVM;
use App\Modules\Auth\User\ViewModels\Dashboard\TotalNumOfGettingChatsVM;
use App\Modules\Auth\User\ViewModels\Dashboard\TotalNumOfReceivedDeclinesVM;
use App\Modules\Auth\User\ViewModels\Dashboard\TotalNumOfReceivedLikesVM;
use App\Modules\Auth\User\ViewModels\Dashboard\TotalNumOfReceivedSuperLikesVM;
use App\Modules\Auth\User\ViewModels\Dashboard\TotalNumOfSendDeclinesVM;
use App\Modules\Auth\User\ViewModels\Dashboard\TotalNumOfSendLikesVM;
use App\Modules\Auth\User\ViewModels\Dashboard\TotalNumOfSendSuperLikesVM;
use App\Modules\Auth\User\ViewModels\Dashboard\UserShowVM;
use App\Modules\Auth\User\DataTables\UserDataTable;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $response = UserDataTable::tojson($request);
        $response = Helper::createSuccessDTResponse($response, '');
        return response()->json($response, 200);
    }


    public function showData($user, ShowDataUserRequest $showDataUserRequest)
    {
        //
        $response = Helper::createSuccessResponse(UserShowVM::toArray($user));
        return response()->json($response, 200);
    }

    public function userStatistics($user, UserStatisticsRequest $userStatisticsRequest)
    {
        $total_number_of_send_likes = TotalNumOfSendLikesVM::toAttr($user);
        $total_number_of_send_super_likes = TotalNumOfSendSuperLikesVM::toAttr($user);
        $total_number_of_send_declines = TotalNumOfSendDeclinesVM::toAttr($user);
        $total_number_of_blocked = TotalNumOfBlockedVM::toAttr($user);
        $total_number_of_getting_blocked = TotalNumOfGettingBlockedVM::toAttr($user);
        $total_number_of_chats = TotalNumOfChatsVM::toAttr($user);
        $total_number_of_getting_chats = TotalNumOfGettingChatsVM::toAttr($user);
        $total_number_of_received_likes = TotalNumOfReceivedLikesVM::toAttr($user);
        $total_number_of_send_received_super_likes = TotalNumOfReceivedSuperLikesVM::toAttr($user);
        $total_number_of_received_declines = TotalNumOfReceivedDeclinesVM::toAttr($user);

        $response = Helper::createSuccessResponse([
            'total_number_of_send_likes' => $total_number_of_send_likes,
            'total_number_of_send_super_likes' => $total_number_of_send_super_likes,
            'total_number_of_send_declines' => $total_number_of_send_declines,
            'total_number_of_blocked' => $total_number_of_blocked,
            'total_number_of_getting_blocked' => $total_number_of_getting_blocked,
            'total_number_of_chats' => $total_number_of_chats,
            'total_number_of_getting_chats' => $total_number_of_getting_chats,
            'total_number_of_received_likes' => $total_number_of_received_likes,
            'total_number_of_send_received_super_likes' => $total_number_of_send_received_super_likes,
            'total_number_of_received_declines' => $total_number_of_received_declines,

        ]);

        return response()->json($response, 200);
    }


    public function indexMatchRequests(Request $request)
    {
        $response = MatchRequestDataTable::tojson($request);
        $response = Helper::createSuccessDTResponse($response, '');
        return response()->json($response, 200);
    }

    public function indexUserReports(Request $request)
    {
        $response = UserReportsDataTable::tojson($request);
        $response = Helper::createSuccessDTResponse($response, '');
        return response()->json($response, 200);
    }

    public function userReports(StoreUserReportsRequest $storeUserReportsRequest)
    {
        $userReportsDTO = StoreUserReportsDTO::fromRequest($storeUserReportsRequest);
        $userReports = StoreUserReportsAction::execute($userReportsDTO);
        $response = Helper::createSuccessResponse($userReports, '');
        return response()->json($response, 200);
    }

    public function getAllUsersWithQ()
    {
        $response = Helper::createSuccessResponse(['municipalities' => User::where('name', 'like', "%" . request('q') . "%")->limit(request('limit'))->get()], '');
        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUserRequest $storeUserRequest)
    {
        $userDTO = UserDTO::fromRequest($storeUserRequest);
        $response = Helper::createSuccessResponse(StoreUserAction::execute($userDTO));
        return response()->json(['message' => 'New User Added Successfully!'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserRequest $updateUserRequest, User $user)
    {

        $userDTO = UserDTO::fromRequestForUpdate($updateUserRequest, $user);
        $response = Helper::createSuccessResponse(UpdateUserAction::execute($user, $userDTO));
        return response()->json(['message' => 'User Edited Successfully!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $User
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user)
    {
        //
        DeleteUserAction::execute($user);
        return response()->json(['O_Msg' => 'Item Deleted'], 200);
    }

    public function generateToken(Request $request)
    {
        $appId = "f96e8a61fcb940beb0bb235d1c9984a4";
        $appCertificate = "9d007ba2ef0144c9a8f1b1594cd50e80";
        $channelName = $request['channel_name'] ?? substr(md5(uniqid(mt_rand(), true)), 0, 32);
//        $channelName = "7d72365eb983485397e3e3f9d460bdda";
        $uid = mt_rand(1000000000, 2882341273);
//        $uid = 0;
        $uidStr = "2882341273";
        $tokenExpirationInSeconds = 3600;
        $privilegeExpirationInSeconds = 3600;


        $token = RtcTokenBuilder2::buildTokenWithUid($appId, $appCertificate, $channelName, $uid, RtcTokenBuilder2::ROLE_PUBLISHER, $tokenExpirationInSeconds, $privilegeExpirationInSeconds);
        return [
            'token' => $token,
            'channel' => $channelName,
            'uid' => $uid,
        ];

    }


    public static function unique_id($l = 8)
    {
        return substr(md5(uniqid(mt_rand(), true)), 0, $l);
    }
}
