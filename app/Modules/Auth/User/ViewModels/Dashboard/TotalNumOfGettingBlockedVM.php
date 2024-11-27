<?php

namespace App\Modules\Auth\User\ViewModels\Dashboard;

use App\Modules\Auth\User\Models\BlackListed;
use App\Modules\Auth\User\Models\MatchRequest;
use App\Modules\Auth\User\Models\User;
use Illuminate\Support\Facades\Auth;

class TotalNumOfGettingBlockedVM
{

    public static function handle($user)
    {

        $count = BlackListed::select('*')
            ->where('to_user_id', $user)
            ->count();
        return $count;
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
