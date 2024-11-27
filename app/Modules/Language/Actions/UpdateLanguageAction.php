<?php


namespace App\Modules\Language\Actions;

use App\Helpers\Helper;
use App\Modules\Language\DTO\LanguageDTO;
use App\Modules\Language\Models\Language;
use Illuminate\Support\Facades\Auth;

class UpdateLanguageAction
{
    public static function execute(Language $Language, LanguageDTO $LanguageDTO)
    {
        $Language->update($LanguageDTO->toArray());
        return Helper::createSuccessResponse(['Language' => $Language], 'Updated Successfully');
    }

}
