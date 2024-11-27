<?php


namespace App\Modules\ViewedStatus\Actions;

use App\Helpers\Helper;
use App\Modules\ViewedStatus\DTO\ViewedStatusDTO;
use App\Modules\ViewedStatus\Models\ViewedStatus;
use Illuminate\Support\Facades\Auth;

class UpdateViewedStatusAction
{
    public static function execute(ViewedStatus $ViewedStatus, ViewedStatusDTO $ViewedStatusDTO)
    {
        $ViewedStatus->update($ViewedStatusDTO->toArray());
        return Helper::createSuccessResponse(['ViewedStatus' => $ViewedStatus], 'Updated Successfully');
    }

}
