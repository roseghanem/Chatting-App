<?php

namespace App\Modules\Auth\User\ViewModels;

use App\Modules\Auth\User\Models\MatchRequest;
use App\Modules\Auth\User\Models\User;
use App\Modules\Call\Models\Call;
use App\Modules\ViewedStatus\Models\ViewedStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserMatchQueueIndexVM
{

    public static function handle()
    {
        $matchesFromIds = MatchRequest::where('request_to', Auth::id())->where(function ($query) {
            $query->where('match_requests.status', 1)->orWhere('match_requests.status', 2);
        })->pluck('request_from');
        $matchesIds = MatchRequest::where('request_from', Auth::id())->whereIn('request_to', $matchesFromIds)->where(function ($query) {
            $query->where('match_requests.status', 1)->orWhere('match_requests.status', 2);
        })->pluck('request_to');
        $users = User::whereIn('id', $matchesIds)
            ->select('users.*');
        $users->whereNotIn('users.id', function ($subquery) {
            $subquery->select('to_user_id')->from('opened_bubbles')->where('from_user_id', Auth::id());
        });
        $users->whereNotIn('users.id', function ($subquery) {
            $subquery->select('to_user_id')->from('black_listed')->where('from_user_id', Auth::id());
        });
        $users->whereNotIn('users.id', function ($subquery) {
            $subquery->select('from_user_id')->from('black_listed')->where('to_user_id', Auth::id());
        });
        $allUsers = $users->get();
        $arr = [];
        foreach ($allUsers as $user) {
            $viewed = ViewedStatus::where('from_user_id', Auth::id())->where('to_user_id', $user->id)->first();
            if ($viewed) {
                $user->setAttribute('viewed', true);
            } else {
                $user->setAttribute('viewed', false);
            }
            $called = Call::where(function ($query) use ($user) {
                $query->where('to_user_id', Auth::id())->where('from_user_id', $user->id);
            })
                ->orWhere(function ($query) use ($user) {
                    $query->where('from_user_id', Auth::id())->where('to_user_id', $user->id);
                })->first();
            if ($called) {
                $user->setAttribute('called', true);
            } else {
                $user->setAttribute('called', false);
            }
            $arr[] = $user;
        }
        return $arr;


    }

    public static function toArray()
    {
        return ['users' => self::handle()];
    }
}
