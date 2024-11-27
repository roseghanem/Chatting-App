<?php


namespace App\Modules\Call\Actions;

use App\Helpers\Helper;
use App\Modules\Call\DTO\CallDTO;
use App\Modules\Call\Models\Call;
use Illuminate\Support\Facades\Auth;

class UpdateCallAction
{
    public static function execute(Call $Call, CallDTO $CallDTO)
    {
        $Call->update($CallDTO->toArray());
        return Helper::createSuccessResponse(['Call' => $Call], 'Updated Successfully');
    }

}
