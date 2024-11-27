<?php


namespace App\Modules\Auth\User\DTO;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\DataTransferObject\DataTransferObject;


class UnMatchUserDTO extends DataTransferObject
{
    /** @var int $from_user_id */
    public $from_user_id;

    /** @var int $to_user_id */
    public $to_user_id;


    public static function fromRequest($request)
    {
        return new self([
            'from_user_id' => Auth::id(),
            'to_user_id' => $request['to_user_id'],
        ]);
    }
}
