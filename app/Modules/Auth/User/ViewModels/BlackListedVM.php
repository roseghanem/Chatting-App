<?php

namespace App\Modules\Auth\User\ViewModels;

use App\Modules\Auth\User\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlackListedVM
{

    public static function handle()
    {
        $users = User::join('black_listed', 'users.id', '=', 'black_listed.to_user_id')
            ->where('black_listed.from_user_id', '=', Auth::id())
            ->select('users.*')
            ->get();
        return $users;
    }

    public static function toArray()
    {
        return ['users' => self::handle()];
    }
}
