<?php


namespace App\Modules\Auth\User\Actions;


use App\Modules\Auth\User\DTO\AuthUserDTO;
use App\Modules\Auth\User\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthUserAction
{
    public static function execute(AuthUserDTO $userDTO)
    {
        $credentials = $userDTO->only('email', 'password')->toArray();
        if (Auth::guard('web')->attempt($credentials)) return true;
        return false;
    }

}
