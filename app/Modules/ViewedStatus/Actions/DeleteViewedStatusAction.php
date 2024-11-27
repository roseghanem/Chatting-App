<?php


namespace App\Modules\ViewedStatus\Actions;

use App\Helpers\Helper;
use App\Modules\ViewedStatus\Models\ViewedStatus;

class DeleteViewedStatusAction
{
    public static function execute(ViewedStatus $ViewedStatus)
    {
        $ViewedStatus->delete();
        return Helper::createSuccessResponse([], 'Deleted Successfully');
    }

}
