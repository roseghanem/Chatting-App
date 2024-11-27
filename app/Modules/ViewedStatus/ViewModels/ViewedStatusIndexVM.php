<?php

namespace App\Modules\ViewedStatus\ViewModels;

use App\Modules\ViewedStatus\Models\ViewedStatus;

class ViewedStatusIndexVM
{

    public static function handle()
    {
        $ViewedStatuses = ViewedStatus::all();
        $arr = [];
        foreach ($ViewedStatuses as $ViewedStatus) {
            $ViewedStatusVM = new ViewedStatusShowVM();
            array_push($arr, $ViewedStatusVM->toAttr($ViewedStatus));
        }
        return $arr;
    }

    public static function toArray()
    {
        return ['ViewedStatuss' => self::handle()];
    }
}
