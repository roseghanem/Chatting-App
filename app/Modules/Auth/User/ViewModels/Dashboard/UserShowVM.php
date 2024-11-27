<?php

namespace App\Modules\Auth\User\ViewModels\Dashboard;

use App\Modules\Auth\User\Models\User;

class UserShowVM
{

    public static function handle($user)
    {
        $user = User::find($user);
        return $user;
    }

    public static function toArray($user)
    {
        return ['User' => self::handle($user)];
    }

    public static function toAttr($user)
    {
        return self::handle($user);
    }
}
