<?php

namespace App\Modules\Auth\User\ViewModels;

use App\Modules\Auth\User\Models\User;
use App\Modules\Call\Models\Call;
use App\Modules\ViewedStatus\Models\ViewedStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserLikesMatchRequestsIndexVM
{

    public static function handle()
    {
        $users = User::join('match_requests', function ($join) {
            $join->on('users.id', '=', 'match_requests.request_from')
                ->where('match_requests.request_to', '=', Auth::id())
                ->where(function ($query) {
                    $query->where('match_requests.status', 1);
                });
        });
        $users->whereNotIn('users.id', function ($subquery) {
            $subquery->select('request_to')->from('match_requests')->where('request_from', Auth::id());
        });
        $users->whereNotIn('users.id', function ($subquery) {
            $subquery->select('to_user_id')->from('black_listed')->where('from_user_id', Auth::id());
        });
        $users->whereNotIn('users.id', function ($subquery) {
            $subquery->select('from_user_id')->from('black_listed')->where('to_user_id', Auth::id());
        });
        $users->select('users.*');
        $allUsers = $users->get();
        $arr = [];
        foreach ($allUsers as $user){
            $viewed = ViewedStatus::where('from_user_id',Auth::id())->where('to_user_id',$user->id)->first();
            if($viewed){
                $user->setAttribute('viewed',true);
            }
            else{
                $user->setAttribute('viewed',false);
            }
            $called = Call::where(function ($query) use ($user) {
                $query->where('to_user_id', $user->id)->where('from_user_id', Auth::id());
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
