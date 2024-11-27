<?php


namespace App\Modules\Language\Actions;

use App\Helpers\Helper;
use App\Modules\Language\Models\Language;

class DeleteLanguageAction
{
    public static function execute(Language $Language)
    {
        $Language->delete();
        return Helper::createSuccessResponse([], 'Deleted Successfully');
    }

}
