<?php

namespace App\Modules\Call\ViewModels;

use App\Modules\Call\Models\Call;

class CallIndexVM
{

    public static function handle()
    {
        $Calls = Call::all();
        $arr = [];
        foreach ($Calls as $Call) {
            $CallVM = new CallShowVM();
            array_push($arr, $CallVM->toAttr($Call));
        }
        return $arr;
    }

    public static function toArray()
    {
        return ['Calls' => self::handle()];
    }
}
