<?php

namespace App\Modules\Language\ViewModels;

use App\Modules\Language\Models\Language;

class LanguageShowVM
{

    public static function handle($Language)
    {
        return $Language;
    }

    public static function toArray(Language $Language)
    {
        return ['Language' => self::handle($Language)];
    }

    public static function toAttr(Language $Language)
    {
        return self::handle($Language);
    }
}
