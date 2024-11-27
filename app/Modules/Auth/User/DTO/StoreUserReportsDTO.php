<?php


namespace App\Modules\Auth\User\DTO;

use Illuminate\Support\Facades\Hash;
use Spatie\DataTransferObject\DataTransferObject;


class StoreUserReportsDTO extends DataTransferObject
{

    /** @var string $report_from_user_id */
    public $report_from_user_id;

    /** @var string $report_to_user_id */
    public $report_to_user_id;

    /** @var string $reason */
    public $reason;


    public static function fromRequest($request)
    {
        return new self([
            'report_from_user_id' => $request['report_from_user_id'],
            'report_to_user_id' => $request['report_to_user_id'],
            'reason' => $request['reason'],
        ]);
    }

    public static function fromRequestForUpdate($request, $user)
    {
        return new self([
            'report_from_user_id' => isset($request['report_from_user_id'])  ? $request['report_from_user_id'] : $user->report_from_user_id,
            'report_to_user_id' => isset($request['report_to_user_id']) ? $request['report_to_user_id'] : $user->report_to_user_id,
            'reason' => isset($request['reason']) ? $request['reason'] : $user->reason,

        ]);
    }
}
