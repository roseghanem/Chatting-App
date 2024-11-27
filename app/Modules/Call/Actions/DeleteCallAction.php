<?php


namespace App\Modules\Call\Actions;

use App\Helpers\Helper;
use App\Modules\Call\Models\Call;

class DeleteCallAction
{
    public static function execute(Call $Call)
    {
        $Call->delete();
        return Helper::createSuccessResponse([], 'Deleted Successfully');
    }

}
