<?php


namespace App\Modules\Auth\User\Actions;

use App\Modules\Auth\User\DTO\BlackListedDTO;
use App\Modules\Auth\User\DTO\OpenedBubblesDTO;
use App\Modules\Auth\User\DTO\UserDTO;
use App\Modules\Auth\User\Models\BlackListed;
use App\Modules\Auth\User\Models\OpenedBubble;
use App\Modules\Auth\User\Models\User;
use Illuminate\Support\Facades\Auth;

class StoreBlackListedAction
{

    public static function execute(BlackListedDTO $blackListedDTO)
    {
        $blackListed = new BlackListed($blackListedDTO->toArray());
        $blackListed->save();
        return $blackListed;
    }

}
