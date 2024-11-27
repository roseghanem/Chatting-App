<?php

namespace App\Modules\Auth\User\ViewModels;

use App\Modules\Auth\User\Models\User;
use App\Modules\Call\Models\Call;
use App\Modules\ViewedStatus\Models\ViewedStatus;
use Illuminate\Support\Facades\Auth;

class UserShowVM
{

    public static function handle($user)
    {
        $user = User::find($user);
        unset($user->languages);
        $user->languages;
        unset($user->images);
        $user->images;

        $viewed = ViewedStatus::where('from_user_id', Auth::id())->where('to_user_id', $user->id)->first();
        if ($viewed) {
            $user->setAttribute('viewed', true);
        } else {
            $user->setAttribute('viewed', false);
        }

        $called = Call::where(function ($query) use ($user) {
            $query->where('to_user_id', Auth::id())->where('from_user_id', $user->id);
        })
            ->orWhere(function ($query) use ($user) {
                $query->where('from_user_id', Auth::id())->where('to_user_id', $user->id);
            })->get();
        if ($called) {
            $user->setAttribute('called', true);
        } else {
            $user->setAttribute('called', false);
        }

        return $user;
    }

    public static function toArray($user)
    {
        return ['user' => self::handle($user)];
    }

    public static function toAttr($user)
    {
        return self::handle($user);
    }
}
