<?php

namespace App\Modules\Auth\User\ViewModels;

use App\Modules\Auth\User\Models\User;

class UserIndexVM
{

    public static function handle()
    {
        $users = User::all();
        $arr = [];
        foreach ($users as $user) {
            $userVM = new UserShowVM();
            array_push($arr, $userVM->toAttr($user));
        }
        return $arr;
    }

    public static function toArray()
    {
        return ['users' => self::handle()];
    }
}
