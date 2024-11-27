<?php


namespace App\Modules\Auth\User\Actions;

use App\Modules\Auth\User\DTO\OpenedBubblesDTO;
use App\Modules\Auth\User\DTO\UserDTO;
use App\Modules\Auth\User\Models\OpenedBubble;
use App\Modules\Auth\User\Models\User;
use Illuminate\Support\Facades\Auth;

class StoreOpenedBubblesAction
{

    public static function execute(OpenedBubblesDTO $openedBubblesDTO)
    {
        $openedbubble = new OpenedBubble($openedBubblesDTO->toArray());
        $openedbubble->save();
        return $openedbubble;
    }
}
