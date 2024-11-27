<?php


namespace App\Modules\Auth\User\Actions;

use App\Modules\Auth\User\DTO\UserDTO;
use App\Modules\Auth\User\Models\User;
use Illuminate\Support\Facades\Auth;

class StoreUserAction
{

    public static function execute(UserDTO $userDTO)
    {
        $user = new User($userDTO->toArray());
        $user->save();
        return $user;
    }
}
