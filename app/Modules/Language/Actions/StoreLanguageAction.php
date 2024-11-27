<?php


namespace App\Modules\Language\Actions;

use App\Helpers\Helper;
use App\Modules\Language\DTO\LanguageDTO;
use App\Modules\Language\Models\Language;

class StoreLanguageAction
{

    public static function execute(LanguageDTO $LanguageDTO)
    {
        $Language = new Language($LanguageDTO->toArray());
        $Language->save();
        return Helper::createSuccessResponse(['Language' => $Language], 'Added Successfully');
    }
}
