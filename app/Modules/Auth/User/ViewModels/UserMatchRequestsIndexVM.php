<?php

namespace App\Modules\Auth\User\ViewModels;

use App\Modules\Auth\User\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserMatchRequestsIndexVM
{

    public static function handle()
    {
        $users = User::join('match_requests', function ($join) {
            $join->on('users.id', '=', 'match_requests.request_from')
                ->where('match_requests.request_to', '=', Auth::id())
                ->where(function ($query) {
                    $query->where('match_requests.status', 1)->orWhere('match_requests.status', 2);
                });
        })
            ->select('users.*')
            ->get();
        return $users;
    }

    public static function toArray()
    {
        return ['users' => self::handle()];
    }
}
