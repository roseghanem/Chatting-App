<?php


namespace App\Modules\Auth\User\Actions;

use App\Helpers\Helper;
use App\Modules\Auth\User\DTO\UserDTO;
use App\Modules\Auth\User\Models\MatchRequest;
use App\Modules\Auth\User\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SendMatchRequestAction
{
    public static function execute($user, $request)
    {
        $user = User::find($user);
        $num_sent_req = MatchRequest::where('request_from',Auth::id())->whereDate('created_at', Carbon::today())->count();
        $auth_user = User::find(Auth::id());
        if($num_sent_req >= $auth_user->max_sent_req){
            $response = Helper::createErrorResponse([], 'You can not send more requests today');
            $response = response()->json($response, 500);
            return $response;
        }
        if ($user->id !== Auth::id()) {
            $exists = MatchRequest::where(function ($query) use ($user) {
                $query->where('request_from', Auth::id())->where('request_to', $user->id);
            })
//                ->orWhere(function ($query) use ($user) {
//                    $query->where('request_from', $user->id)->where('request_to', Auth::id());
//                })
                ->first();
            if (!$exists) {
                $otherUserAccepted = MatchRequest::Where(function ($query) use ($user) {
                    $query->where('request_from', $user->id)->where('request_to', Auth::id())->where(function ($subQuery) {
                        $subQuery->where('status', 1)->orWhere('status', 2);
                    });
                })
                    ->first();
                $matchRequest = MatchRequest::create([
                    'request_from' => Auth::id(),
                    'request_to' => $user->id,
                    'status' => $request->status ?? '1'
                ]);
                $matchRequest->boom = $request->status === 1 || $request->status === 2 ? isset($otherUserAccepted->id) : false;
//                if (isset($otherUserAccepted->id) && $otherUserAccepted->id > 0) {
//                    $matchRequest->matched_user = User::find($otherUserAccepted->request_from);
//                }
                $matchRequest->matched_user = User::find($matchRequest->request_to);
                $response = Helper::createSuccessResponse($matchRequest, 'success');
                $response = response()->json($response, 200);
            } else {
                $response = Helper::createErrorResponse([], 'Match already exists');
                $response = response()->json($response, 500);
            }
        } else {
            $response = Helper::createErrorResponse([], 'User cannot match himself');
            $response = response()->json($response, 500);
        }

        return $response;
    }

}
