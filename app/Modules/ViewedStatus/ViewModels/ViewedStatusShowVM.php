<?php

namespace App\Modules\ViewedStatus\ViewModels;

use App\Modules\ViewedStatus\Models\ViewedStatus;

class ViewedStatusShowVM
{

    public static function handle($ViewedStatus)
    {
        return $ViewedStatus;
    }

    public static function toArray(ViewedStatus $ViewedStatus)
    {
        return ['ViewedStatus' => self::handle($ViewedStatus)];
    }

    public static function toAttr(ViewedStatus $ViewedStatus)
    {
        return self::handle($ViewedStatus);
    }
}
