<?php

namespace App\Modules\Call\ViewModels;

use App\Modules\Call\Models\Call;

class CallShowVM
{

    public static function handle($Call)
    {
        return $Call;
    }

    public static function toArray(Call $Call)
    {
        return ['Call' => self::handle($Call)];
    }

    public static function toAttr(Call $Call)
    {
        return self::handle($Call);
    }
}
