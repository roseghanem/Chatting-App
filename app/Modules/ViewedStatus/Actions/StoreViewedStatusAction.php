<?php


namespace App\Modules\ViewedStatus\Actions;

use App\Helpers\Helper;
use App\Modules\ViewedStatus\DTO\ViewedStatusDTO;
use App\Modules\ViewedStatus\Models\ViewedStatus;

class StoreViewedStatusAction
{

    public static function execute(ViewedStatusDTO $ViewedStatusDTO)
    {
        $ViewedStatus = new ViewedStatus($ViewedStatusDTO->toArray());
        $ViewedStatus->save();
        return Helper::createSuccessResponse(['ViewedStatus' => $ViewedStatus], 'Added Successfully');
    }
}
