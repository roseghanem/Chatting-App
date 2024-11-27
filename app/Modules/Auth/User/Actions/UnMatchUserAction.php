<?php


namespace App\Modules\Auth\User\Actions;

use App\Modules\Auth\User\DTO\UnMatchUserDTO;
use App\Modules\Auth\User\DTO\UserDTO;
use App\Modules\Auth\User\Models\MatchRequest;
use App\Modules\Auth\User\Models\User;
use App\Modules\Auth\User\Models\UserImage;
use Illuminate\Support\Facades\Auth;

class UnMatchUserAction
{
    public static function execute(UnMatchUserDTO $unMatchUserDTO)
    {
        $user = MatchRequest::where('request_from', '=', Auth::id())->where('request_to', '=', $unMatchUserDTO->to_user_id)->first();
        $user->status = 3;
        $user->update();
        return $user;
    }

}
