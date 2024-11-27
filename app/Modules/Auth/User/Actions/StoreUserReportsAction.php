<?php


namespace App\Modules\Auth\User\Actions;


use App\Modules\Auth\User\DTO\AuthUserDTO;
use App\Modules\Auth\User\DTO\StoreUserReportsDTO;
use App\Modules\Auth\User\Models\User;
use Illuminate\Support\Facades\Auth;

class StoreUserReportsAction
{
    public static function execute(StoreUserReportsDTO $userReportsDTO)
    {
        $user = new User($userReportsDTO->toArray());
        $user->save();
        return $user;
    }

}
