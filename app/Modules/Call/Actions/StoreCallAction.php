<?php


namespace App\Modules\Call\Actions;

use App\Helpers\Helper;
use App\Modules\Call\DTO\CallDTO;
use App\Modules\Call\Models\Call;

class StoreCallAction
{

    public static function execute(CallDTO $CallDTO)
    {
        $Call = new Call($CallDTO->toArray());
        $Call->save();
        return Helper::createSuccessResponse(['Call' => $Call], 'Added Successfully');
    }
}
