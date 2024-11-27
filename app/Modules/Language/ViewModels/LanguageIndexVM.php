<?php

namespace App\Modules\Language\ViewModels;

use App\Modules\Language\Models\Language;

class LanguageIndexVM
{

    public static function handle()
    {
        $Languages = Language::all();
        $arr = [];
        foreach ($Languages as $Language) {
            $LanguageVM = new LanguageShowVM();
            array_push($arr, $LanguageVM->toAttr($Language));
        }
        return $arr;
    }

    public static function toArray()
    {
        return ['Languages' => self::handle()];
    }
}
