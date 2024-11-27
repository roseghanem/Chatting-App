<?php

namespace App\Modules\Call\Controllers;

use App\Modules\Call\Actions\DeleteCallAction;
use App\Modules\Call\Actions\StoreCallAction;
use App\Modules\Call\Actions\UpdateCallAction;
use App\Modules\Call\DataTables\UserDataTable;
use App\Modules\Call\DTO\CallDTO;
use App\Modules\Call\Models\Call;
use App\Modules\Call\Requests\StoreCallRequest;
use App\Modules\Call\Requests\UpdateCallRequest;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Modules\Call\ViewModels\CallShowVM;
use Illuminate\Http\Request;

class CallDashboardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $response = UserDataTable::toJson($request);
        $response = Helper::createSuccessDTResponse($response, '');
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Call $Call
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Call $Call)
    {
        //
        $response = Helper::createSuccessResponse(CallShowVM::toArray($Call));
        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCallRequest $storeCallRequest)
    {
        $CallDTO = CallDTO::fromRequest($storeCallRequest);
        $response = Helper::createResponse(StoreCallAction::execute($CallDTO));
        return response()->json($response, $response['code']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCallRequest $updateCallRequest, $Call)
    {
        $Call = Call::find($Call);
        $CallDTO = CallDTO::fromRequestForUpdate($updateCallRequest, $Call);
        $response = Helper::createResponse(UpdateCallAction::execute($Call, $CallDTO));
        return response()->json($response, $response['code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Call $Call
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($Call)
    {
        //
        $Call = Call::find($Call);
        $response = Helper::createResponse(DeleteCallAction::execute($Call));
        return response()->json($response, $response['code']);
    }

    public function generateToken(Request $request)
    {
        $appID = "f96e8a61fcb940beb0bb235d1c9984a4";
        $appCertificate = "9d007ba2ef0144c9a8f1b1594cd50e80";
        $user = "test_user_id";
        $role = RtmTokenBuilder::RoleRtmUser;
        $expireTimeInSeconds = 3600;
        $currentTimestamp = (new \DateTime("now", new \DateTimeZone('UTC')))->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;

        $token = RtmTokenBuilder::buildToken($appID, $appCertificate, $user, $role, $privilegeExpiredTs);


        $channelName = substr(md5(uniqid(mt_rand(), true)), 0, 32);
//        $channelName = "7d72365eb983485397e3e3f9d460bdda";
        $ts = 1446455472;
        $randomInt = 58964981;
        $uid = 2882341273;
        $expiredTs = 1446455471;

        $token = (new \App\Modules\Auth\User\Actions\DynamicTokenClass)->generateMediaChannelKey($appID, $appCertificate, $channelName, $ts, $randomInt, $uid, $expiredTs);
        return [
            'tokenWithUid' => $token,
            'channel_name' => $channelName,
            'uid' => $uid
        ];
    }
}
