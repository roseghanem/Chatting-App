<?php

namespace App\Modules\Auth\User\ViewModels\Dashboard;

use App\Modules\Auth\User\Models\MatchRequest;
use App\Modules\Auth\User\Models\User;
use Illuminate\Support\Facades\Auth;

class TotalNumOfReceivedLikesVM
{

    public static function handle($user)
    {

        $count = MatchRequest::select('*')
            ->where('request_to', $user)
            ->where('status', 1)
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
