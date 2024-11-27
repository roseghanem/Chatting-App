<?php

namespace App\Modules\Auth\User\Controllers;

use App\Modules\Agora\src\RtcTokenBuilder2;
use App\Modules\Auth\User\Actions\SendMatchRequestAction;
use App\Modules\Auth\User\Actions\StoreBlackListedAction;
use App\Modules\Auth\User\Actions\StoreOpenedBubblesAction;
use App\Modules\Auth\User\Actions\StoreUserAction;
use App\Modules\Auth\User\Actions\DeleteUserAction;
use App\Modules\Auth\User\Actions\UnMatchUserAction;
use App\Modules\Auth\User\Actions\UpdateUserAction;
use App\Modules\Auth\User\DTO\BlackListedDTO;
use App\Modules\Auth\User\DTO\OpenedBubblesDTO;
use App\Modules\Auth\User\DTO\UnMatchUserDTO;
use App\Modules\Auth\User\DTO\UserDTO;
use App\Modules\Auth\User\Models\User;
use App\Modules\Auth\User\Requests\StoreBlackListedRequest;
use App\Modules\Auth\User\Requests\StoreOpenedBubblesRequest;
use App\Modules\Auth\User\Requests\StoreUserRequest;
use App\Modules\Auth\User\Requests\UnMatchUserRequest;
use App\Modules\Auth\User\Requests\UpdateUserRequest;
use App\Modules\Auth\User\ViewModels\UserIndexVM;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Modules\Auth\User\ViewModels\UserLikesMatchRequestsIndexVM;
use App\Modules\Auth\User\ViewModels\UserMatchingIndexVM;
use App\Modules\Auth\User\ViewModels\UserMatchQueueIndexVM;
use App\Modules\Auth\User\ViewModels\UserMatchRequestsIndexVM;
use App\Modules\Auth\User\ViewModels\UserShowVM;
use App\Modules\Auth\User\ViewModels\UserSuperLikesMatchRequestsIndexVM;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $response = Helper::createSuccessResponse(UserIndexVM::toArray());
        return response()->json($response, 200);
    }

    //opened bubbles
    public function storeOpenedBubbles(StoreOpenedBubblesRequest $storeOpenedBubblesRequest)
    {
        $bubblesDTO = OpenedBubblesDTO::fromRequest($storeOpenedBubblesRequest);
        $openedbubble = StoreOpenedBubblesAction::execute($bubblesDTO);
        $response = Helper::createSuccessResponse($openedbubble, 'added successfully');
        return response()->json($response, 200);
    }

    //black list
    public function storeBlackListed(StoreBlackListedRequest $createBlackListedRequest)
    {
        $blacklistedDTO = BlackListedDTO::fromRequest($createBlackListedRequest);
        $blacklisted = StoreBlackListedAction::execute($blacklistedDTO);
        $response = Helper::createSuccessResponse($blacklisted, 'Added successfully to Black list');
        return response()->json($response, 200);
    }

    //un match user
    public function unmatchUser(UnMatchUserRequest $unmatchUserRequest)
    {
        $unmatchUserDTO = UnMatchUserDTO::fromRequest($unmatchUserRequest);
        $unMatchUser = UnMatchUserAction::execute($unmatchUserDTO);
        $response = Helper::createSuccessResponse($unMatchUser, 'User unmatch successfuly');
        return response()->json($response, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function matchings(Request $request)
    {
        $response = Helper::createSuccessResponse(UserMatchingIndexVM::toArray($request));
        return response()->json($response, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function matchRequests()
    {
        $response = Helper::createSuccessResponse(UserMatchRequestsIndexVM::toArray());
        return response()->json($response, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function likesMatchRequests()
    {
        $response = Helper::createSuccessResponse(UserLikesMatchRequestsIndexVM::toArray());
        return response()->json($response, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function superLikesMatchRequests()
    {
        $response = Helper::createSuccessResponse(UserSuperLikesMatchRequestsIndexVM::toArray());
        return response()->json($response, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function matchQueue()
    {
        $response = Helper::createSuccessResponse(UserMatchQueueIndexVM::toArray());
        return response()->json($response, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMatchRequest($user, Request $request)
    {
        return SendMatchRequestAction::execute($user, $request);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function reportUser(Request $request)
    {
        DB::table('user_reports')->insert([
            'report_from_user_id' => Auth::id(),
            'report_to_user_id' => $request->report_to_user_id,
            'reason' => $request->reason,
            'created_at' => Carbon::now()
        ]);
        $response = Helper::createSuccessResponse([], 'Reported Successfully');
        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * //     * @param StoreUserRequest $createUserRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUserRequest $createUserRequest)
    {
        //
        $user = User::where('phone', $createUserRequest->phone)->first();
        if ($user) {
            $response = Helper::createSuccessResponse([
                'exist' => $user->email ? true : false,
                "token_type" => "Bearer",
                'token' => $user->createToken('User', ['user'])->accessToken,
                'user' => $user
            ], 'success');
        } else {
            $UserDTO = UserDTO::fromRequest($createUserRequest);
            $user = StoreUserAction::execute($UserDTO);
            $response = Helper::createSuccessResponse([
                'exist' => false,
                "token_type" => "Bearer",
                'token' => $user->createToken('User', ['user'])->accessToken,
                'user' => $user
            ], 'success');
        }
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param User $User
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($user)
    {
        //
        $response = Helper::createSuccessResponse(UserShowVM::toArray($user));
        return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $updateUserRequest
     * @param User $User
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserRequest $updateUserRequest)
    {
        //
        $user = User::find(Auth::id());
        $userDTO = UserDTO::fromRequestForUpdate($updateUserRequest, $user);
        $user = UpdateUserAction::execute($user, $userDTO);
        $response = UserShowVM::toArray($user->id);
        $response = Helper::createSuccessResponse($response);
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $User
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy()
    {
        //
        $user = User::find(Auth::id());
        DeleteUserAction::execute($user);
        return response()->json(['O_Msg' => 'Item Deleted'], 200);
    }

    public function generateToken(Request $request)
    {
        $appID = 'f96e8a61fcb940beb0bb235d1c9984a4';
        $appCertificate = "9d007ba2ef0144c9a8f1b1594cd50e80";
        $channelName = '$request->channelName';
        $user = 'Auth::user()->name';
        $role = RtcTokenBuilder2::ROLE_PUBLISHER;
        $expireTimeInSeconds = 3600;
        $currentTimestamp = now()->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;

        $token = RtcTokenBuilder2::buildTokenWithUserAccount($appID, $appCertificate, $channelName, $user, $role, $privilegeExpiredTs);

        return $token;
    }
}
