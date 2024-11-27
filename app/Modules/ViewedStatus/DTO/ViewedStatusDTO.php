<?php


namespace App\Modules\ViewedStatus\DTO;

use Illuminate\Support\Facades\Auth;
use Spatie\DataTransferObject\DataTransferObject;


class ViewedStatusDTO extends DataTransferObject
{

    /** @var string $from_user_id*/
    public $from_user_id;

    /** @var string $to_user_id*/
    public $to_user_id;

    public static function fromRequest($request)
    {
        return new self([
            'from_user_id' => Auth::id(),
            'to_user_id' => $request['to_user_id']
        ]);
    }

    public static function fromRequestForUpdate($request, $ViewedStatus)
    {
        return new self([
            'from_user_id' => isset($request['from_user_id']) ? $request['from_user_id'] : Auth::id(),
            'to_user_id' => isset($request['to_user_id']) ? $request['to_user_id'] : $ViewedStatus->to_user_id
        ]);
    }
}
